<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;

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
            return redirect()->route('students.index');
        }

        // Check Teacher
        $teacher = Teacher::where('username', $username)->first();
        if($teacher && Hash::check($password, $teacher->password)){
            Session::put('username', $teacher->username);
            Session::put('role', 'Teacher');
            return redirect()->route('teachers.index');
        }

        return back()->with('error', 'Invalid username or password');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
