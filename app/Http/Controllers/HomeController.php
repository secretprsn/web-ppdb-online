<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Major;
use App\Models\Schedule;

class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()->take(4)->get();
        $schedules     = Schedule::orderBy('tanggal_mulai')->get();
        $majors        = Major::withCount('registrations')->get();

        return view('welcome', compact('announcements', 'schedules', 'majors'));
    }
}
