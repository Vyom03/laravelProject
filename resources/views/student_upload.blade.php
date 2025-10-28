@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Upload Student CSV File</h3>
    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="csv_file">Choose CSV File</label>
            <input type="file" name="csv_file" class="form-control" required accept=".csv">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Upload</button>
    </form>
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
    @endif
</div>
@endsection
