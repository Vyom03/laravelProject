@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>{{ $student->name }}'s Grades</h3>

    @if($grade)
        <table class="table table-bordered w-50">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks (out of 100)</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Math</td><td>{{ $grade->math }}</td></tr>
                <tr><td>Science</td><td>{{ $grade->science }}</td></tr>
                <tr><td>English</td><td>{{ $grade->english }}</td></tr>
            </tbody>
        </table>
    @else
        <p>No grades available yet.</p>
    @endif
</div>
@endsection
