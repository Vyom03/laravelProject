<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function showMyGrades()
{
    $username = session('username');
    $student = \App\Models\Student::where('username', $username)->first();

    if (!$student) {
        abort(404, 'Student not found');
    }

    // Load grade relation (may be null if not assigned)
    $grade = $student->grade;

    return view('grades.my_grades', compact('student', 'grade'));
}
    public function index()
{
    if (!in_array(session('role'), ['Teacher', 'Admin'])) {
        abort(403, 'Unauthorized');
    }

    $students = \App\Models\Student::with('grade')->get();

    return view('grades.index', compact('students'));
}

    // Show form for given student id
public function edit($id)
{
    if (!in_array(session('role'), ['Teacher', 'Admin'])) {
        abort(403, 'Unauthorized');
    }

    $student = \App\Models\Student::findOrFail($id);
    $grade = $student->grade;

    return view('grades.edit', compact('student', 'grade'));
}

// Store or update grades submitted from form
public function update(Request $request, $id)
{
    if (!in_array(session('role'), ['Teacher', 'Admin'])) {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'math' => 'required|integer|min:0|max:100',
        'science' => 'required|integer|min:0|max:100',
        'english' => 'required|integer|min:0|max:100',
    ]);

    $student = \App\Models\Student::findOrFail($id);

    $grade = $student->grade;
    if (!$grade) {
        $grade = new \App\Models\Grade();
        $grade->student_id = $student->id;
    }

    $grade->math = $request->math;
    $grade->science = $request->science;
    $grade->english = $request->english;
    $grade->save();

    return redirect()->route('grades.index')->with('success', 'Grades updated successfully');
}

    

}
