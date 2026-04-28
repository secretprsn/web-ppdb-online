<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;
use App\Exports\StudentsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'registration.major']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('asal_sekolah', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->whereHas('registration', fn($q) => $q->where('status_verifikasi', $request->status));
        }

        $students = $query->latest()->paginate(15)->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load(['user', 'documents', 'registration.major']);
        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new StudentsExport, 'data-siswa-ppdb.xlsx');
    }
}
