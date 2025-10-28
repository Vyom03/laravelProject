@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Add a New Student</h3>

    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <input type="text" name="class" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>
@endsection
