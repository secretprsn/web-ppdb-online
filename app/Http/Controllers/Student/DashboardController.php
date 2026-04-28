<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = auth()->user();
        $student = $user->student;

        $announcements = Announcement::published()->take(3)->get();
        $schedules     = Schedule::orderBy('tanggal_mulai')->get();

        return view('student.dashboard', compact('user', 'student', 'announcements', 'schedules'));
    }
}
