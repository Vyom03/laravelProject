<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\GradeController;

// Public routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// General routes without role restrictions
Route::get('/', function () {
    return redirect()->route('students.index'); // or your preferred default page
})->name('home');

// Students routes
Route::get('/students/add', [StudentController::class, 'showAddForm'])->name('students.add');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
//Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/{id}/update', [StudentController::class, 'update'])->name('students.update');
Route::post('/students/{id}/delete', [StudentController::class, 'destroy'])->name('students.delete');
Route::get('/students/upload', [StudentController::class, 'showUploadForm'])->name('students.upload');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');

// Teachers routes
Route::get('/teachers/add', [TeacherController::class, 'showAddForm'])->name('teachers.add');
Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
//Route::get('/teachers/search', [TeacherController::class, 'search'])->name('teachers.search');
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::post('/teachers/{id}/update', [TeacherController::class, 'update'])->name('teachers.update');
Route::post('/teachers/{id}/delete', [TeacherController::class, 'destroy'])->name('teachers.delete');

// Export routes
Route::get('/export', function () {
    return view('export_page');
})->name('export.page');
Route::get('/export/students', [ExportController::class, 'exportStudents'])->name('export.students');
Route::get('/export/teachers', [ExportController::class, 'exportTeachers'])->name('export.teachers');
Route::get('/export/everyone', [ExportController::class, 'exportEveryone'])->name('export.everyone');

Route::post('/logs/send', [LogController::class, 'sendLogsEmail'])->name('logs.send');

// View all grades (Teacher/Admin)
Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');

// View logged-in student's own grades
Route::get('/grades/my', [GradeController::class, 'showMyGrades'])->name('grades.my');

// Edit grades form for teacher/admin
Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');

// Update grades POST
Route::post('/grades/{id}/update', [GradeController::class, 'update'])->name('grades.update');

// Upload grades form (bulk import)
Route::get('/grades/upload', [GradeController::class, 'showUploadForm'])->name('grades.upload.form');
Route::post('/grades/upload', [GradeController::class, 'handleUpload'])->name('grades.upload');