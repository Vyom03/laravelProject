@extends('layout')

@section('content')
<div class="container mt-5">
    <h3>Data Export</h3>
    <div class="list-group mt-4">
        <a href="{{ route('export.students') }}" class="list-group-item list-group-item-action">Export All Students (.csv)</a>
        <a href="{{ route('export.teachers') }}" class="list-group-item list-group-item-action">Export All Teachers (.csv)</a>
        <a href="{{ route('export.everyone') }}" class="list-group-item list-group-item-action">Export Everyone (.csv)</a>
    </div>
</div>
@endsection
