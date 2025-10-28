@extends('layout')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h3>Login</h3>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" required>
        </div>
        @if(session('error'))
            <div class="alert alert-danger mt-2">{{ session('error') }}</div>
        @endif
        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</div>
@endsection
