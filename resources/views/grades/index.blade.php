@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>All Students Grades</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="studentsGradesTable" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Math</th>
                <th>Science</th>
                <th>English</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ optional($student->grade)->math ?? 'N/A' }}</td>
                <td>{{ optional($student->grade)->science ?? 'N/A' }}</td>
                <td>{{ optional($student->grade)->english ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('grades.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit Grades</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#studentsGradesTable').DataTable({
                pageLength: 10
            });
        });
    </script>
</div>
@endsection
