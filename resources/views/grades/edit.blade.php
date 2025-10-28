@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Edit Grades for {{ $student->name }}</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grades.update', $student->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="math">Math (out of 100)</label>
            <input type="number" min="0" max="100" class="form-control" id="math" name="math" value="{{ old('math', optional($grade)->math) }}" required>
        </div>

        <div class="form-group">
            <label for="science">Science (out of 100)</label>
            <input type="number" min="0" max="100" class="form-control" id="science" name="science" value="{{ old('science', optional($grade)->science) }}" required>
        </div>

        <div class="form-group">
            <label for="english">English (out of 100)</label>
            <input type="number" min="0" max="100" class="form-control" id="english" name="english" value="{{ old('english', optional($grade)->english) }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Grades</button>
    </form>
</div>
@endsection
