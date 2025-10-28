<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function showAddForm()
    {
        return view('add_teacher');
    }

    public function index() 
    {
        $teachers = \App\Models\Teacher::all(); 
        return view('teachers_index', compact('teachers'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:teachers,username',
            'password' => 'required|string|min:6',
        ]);

        Teacher::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('teachers.add')->with('success', 'Teacher added successfully!');

        //return back()->with('success', 'Teacher added successfully!');
    }

    // Search
// public function search(Request $request)
// {
//     $query = $request->input('query');
//     $teachers = \App\Models\Teacher::where('name', 'like', "%$query%")
//         ->orWhere('username', 'like', "%$query%")
//         ->paginate(5)
//         ->appends(['query' => $query]);
//     return view('teachers_index', compact('teachers'));
// }

// Edit
public function edit($id) {
    $teacher = \App\Models\Teacher::findOrFail($id);
    return view('teacher_edit', compact('teacher'));
}

// Update
public function update(Request $request, $id) {
    $teacher = \App\Models\Teacher::findOrFail($id);
    $teacher->update($request->only(['name', 'username']));
    return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
}

// Delete
public function destroy($id) {
    $teacher = \App\Models\Teacher::findOrFail($id);
    $teacher->delete();
    return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
}

}
