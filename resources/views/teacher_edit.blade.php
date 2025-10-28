@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Edit Teacher</h3>
    <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" value="{{ $teacher->name }}" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" value="{{ $teacher->username }}" required>
        </div>
        <button class="btn btn-primary" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('teachers.index') }}">Cancel</a>
    </form>
</div>
@endsection
