<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <title>Student Management Project</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Student Management Project</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Add Dropdown for Teachers Only -->
            @if(Session::get('role') === 'Teacher' || Session::get('role') === 'Admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="addDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Add
                    </a>
                    <div class="dropdown-menu" aria-labelledby="addDropdown">
                        <a class="dropdown-item" href="{{ route('students.add') }}">Add Student</a>
                        @if(Session::get('role') === 'Admin')
                        <a class="dropdown-item" href="{{ route('teachers.add') }}">Add Teacher</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('students.upload') }}">Bulk Import Students</a>
                    </div>
                </li>
            @endif
            <!-- View Dropdown for both roles -->
            @if(Session::has('username'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="viewDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View
                    </a>
                    <div class="dropdown-menu" aria-labelledby="viewDropdown">
                        <a class="dropdown-item" href="{{ route('students.index') }}">View Students</a>
                        @if(Session::get('role') === 'Teacher' || Session::get('role') === 'Admin')
                            <a class="dropdown-item" href="{{ route('teachers.index') }}">View Teachers</a>
                        @endif
                    </div>
                </li>
            @endif
            <!-- Export as a standalone item (or dropdown) -->
            @if(Session::get('role') === 'Teacher' || Session::get('role') === 'Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('export.page') }}">Export</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(Session::has('username'))
                <li class="nav-item">
                    <span class="nav-link">Welcome, {{ Session::get('username') }} ({{ Session::get('role') }})</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @endif
            @if(Session::get('role') === 'Admin')
                <form action="{{ route('logs.send') }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-warning">Send Logs (Last 24h)</button>
                </form>
            @endif

        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
</body>
</html>
