@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>All Teachers</h3>
    <form class="form-inline mb-3" method="GET" action="{{ route('teachers.search') }}">
    <input class="form-control mr-2" type="search" name="query" placeholder="Search teachers..." required>
    <button class="btn btn-outline-primary" type="submit">Search</button>
    </form>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="teachersTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->username }}</td>
                <td>
                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('teachers.delete', $teacher->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this teacher?')">Delete</button>
                    </form>
                </td>

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
