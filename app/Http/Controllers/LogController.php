<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivityLogReport;

class LogController extends Controller
{
    public function sendLogsEmail()
    {
        // Only allow teachers!
        if (session('role') !== 'Teacher') {
            abort(403);
        }

        $yesterday = now()->subDay();
        $logs = DB::table('activity_logs')
            ->where('created_at', '>=', $yesterday)
            ->orderBy('created_at', 'desc')
            ->get();

        Mail::to('vyom6943@gmail.com') // Replace with actual teacher email or config
            ->send(new ActivityLogReport($logs));

        return back()->with('success', 'Activity logs sent!');
    }
}
