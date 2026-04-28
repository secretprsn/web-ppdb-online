<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function buktiPendaftaran()
    {
        $student = auth()->user()->student;

        if (!$student || !$student->registration) {
            return redirect()->route('student.dashboard')
                             ->with('error', 'Anda belum memiliki data pendaftaran.');
        }

        $student->load(['registration.major', 'documents']);

        $pdf = Pdf::loadView('student.print.bukti', compact('student'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download("bukti-pendaftaran-{$student->nisn}.pdf");
    }
}
