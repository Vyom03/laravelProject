<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Teacher;

class ExportController extends Controller
{
    public function showExportPage()
    {
        return view('export_page');
    }

    public function exportStudents()
    {
        $students = Student::all(['id','name','username','class','age']);
        $csv = $this->arrayToCsv($students->toArray(), ['ID','Name','Username','Class','Age']);
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="students.csv"');
    }

    public function exportTeachers()
    {
        $teachers = Teacher::all(['id','name','username']);
        $csv = $this->arrayToCsv($teachers->toArray(), ['ID','Name','Username']);
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="teachers.csv"');
    }

    public function exportEveryone()
    {
        $students = Student::all(['id','name','username','class','age']);
        $teachers = Teacher::all(['id','name','username']);
        $everyone = [];
        foreach ($students as $student) {
            $everyone[] = [
                'Role' => 'Student',
                'ID' => $student->id,
                'Name' => $student->name,
                'Username' => $student->username,
                'Class' => $student->class,
                'Age' => $student->age
            ];
        }
        foreach ($teachers as $teacher) {
            $everyone[] = [
                'Role' => 'Teacher',
                'ID' => $teacher->id,
                'Name' => $teacher->name,
                'Username' => $teacher->username,
                'Class' => '', // leave blank for teacher
                'Age' => ''
            ];
        }
        $csv = $this->arrayToCsv($everyone, ['Role','ID','Name','Username','Class','Age']);
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="everyone.csv"');
    }

    // Helper function to convert array to CSV string
    private function arrayToCsv(array $rows, array $header)
    {
        $output = fopen('php://temp', 'r+');
        fputcsv($output, $header);
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }
        rewind($output);
        return stream_get_contents($output);
    }
}
