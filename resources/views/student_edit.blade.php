@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Edit Student</h3>
    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="{{ $student->name }}" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" value="{{ $student->username }}" required>
        </div>
        <div class="form-group">
            <label>Class</label>
            <input class="form-control" name="class" value="{{ $student->class }}" required>
        </div>
        <div class="form-group">
            <label>Age</label>
            <input class="form-control" name="age" value="{{ $student->age }}" required type="number">
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('students.index') }}">Cancel</a>
    </form>
</div>
@endsection
