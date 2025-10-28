<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function showUploadForm() {
        return view('student_upload');
    }

    public function showAddForm() {
    return view('add_student');
}

    public function index()
{
    $students = \App\Models\Student::simplePaginate(5);
    return view('students_index', compact('students'));
}


public function store(Request $request) {
    // Validate data
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:students',
        'password' => 'required|string|min:6',
        'class' => 'required|string|max:50',
        'age' => 'required|integer',
    ]);

    // Save new student
    Student::create([
        'name' => $request->name,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'class' => $request->class,
        'age' => $request->age,
    ]);

    return redirect()->route('students.add')->with('success', 'Student added successfully!');
    //return back()->with('success', 'Student added Successfully!');
}

    public function import(Request $request) {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        $header = fgetcsv($file); // read header row

        // Expected columns: Name, username, password, class, age
        while (($row = fgetcsv($file)) !== false) {
            Student::create([
                'name' => $row[0],
                'username' => $row[1],
                'password' => Hash::make($row[2]), 
                'class' => $row[3],
                'age' => (int)$row[4],
            ]);
        }
        fclose($file);

        return back()->with('success', 'CSV Data Imported Successfully!');
    }

    // Search
public function search(Request $request)
{
    $query = $request->input('query');
    $students = \App\Models\Student::where('name', 'like', "%$query%")
        ->orWhere('username', 'like', "%$query%")
        ->orWhere('class', 'like', "%$query%")
        ->paginate(5)
        ->appends(['query' => $query]); // retain query param in pagination links
    return view('students_index', compact('students'));
}

// Edit
public function edit($id) {
    $student = \App\Models\Student::findOrFail($id);
    return view('student_edit', compact('student'));
}

// Update
public function update(Request $request, $id) {
    $student = \App\Models\Student::findOrFail($id);
    $student->update($request->only(['name', 'username', 'class', 'age']));
    return redirect()->route('students.index')->with('success', 'Student updated successfully!');
}

// Delete
public function destroy($id) {
    $student = \App\Models\Student::findOrFail($id);
    $student->delete();
    return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
}

}
