@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>All Teachers</h3>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="teachersTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                @if(Session::get('role') === 'Admin')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->username }}</td>
                @if(Session::get('role') === 'Admin')
                <td>
                    
                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('teachers.delete', $teacher->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this teacher?')">Delete</button>
                    </form>
                    
                </td>
                @endif

            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
        $('#teachersTable').DataTable({
            pageLength: 5
        });
        });
    </script>

</div>
@endsection
