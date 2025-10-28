@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>All Students</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <!-- <table class="table table-bordered mt-3"> -->
    <table id="studentsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Class</th>
                <th>Age</th>
                @if(Session::get('role') === 'Teacher' || Session::get('role') === 'Admin')
                <th>
                    
                        Action
                    
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->username }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->age }}</td>
                @if(Session::get('role') === 'Teacher' || Session::get('role') === 'Admin')
                <td>
                    
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('students.delete', $student->id) }}" method="POST" style="display:inline;">
                    @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
                        </form>
                    
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable({
                pageLength: 5
            });
        });
    </script>
    {{-- <div class="d-flex justify-content-center mt-3">
    {{ $students->links() }} 
    </div> --}}

</div>
@endsection
