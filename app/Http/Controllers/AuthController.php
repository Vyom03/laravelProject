<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // Check Student
        $student = Student::where('username', $username)->first();
        if($student && Hash::check($password, $student->password)){
            Session::put('username', $student->username);
            Session::put('role', 'Student');
            // After setting session on login
            DB::table('activity_logs')->insert([
                'username' => $student->username,
                'role' => session('role'),
                'action' => 'login',
                'created_at' => now()
            ]);

            return redirect()->route('students.index');
        }

        // Check Teacher
        $teacher = Teacher::where('username', $username)->first();
        if($teacher && Hash::check($password, $teacher->password)){
            Session::put('username', $teacher->username);
            Session::put('role', 'Teacher');
            // After setting session on login
            DB::table('activity_logs')->insert([
                'username' => $teacher->username,
                'role' => session('role'),
                'action' => 'login',
                'created_at' => now()
            ]);

            return redirect()->route('teachers.index');
        }

        return back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        
        DB::table('activity_logs')->insert([
            'username' => session('username'),
            'role' => session('role'),
            'action' => 'logout',
            'created_at' => now()
        ]);
        Session::flush();

        return redirect()->route('login');
    }
}
