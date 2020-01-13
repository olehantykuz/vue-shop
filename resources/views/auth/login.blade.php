@extends('layouts.index')
@section('title', 'Login')
@section('content')
    <form method="POST" action="/login">
    @csrf
        <div class="form-group">
            <label for="email">
                Email address <span class="required">*</span>
            </label>
            <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror">
        </div>
        <div class="form-group">
            <label for="password">
                Password <span class="required">*</span>
            </label>
            <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="submit" value="Login">
    </form>
@endsection
