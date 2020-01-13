@extends('layouts.index')

<style>
    .required {
        color: red;
    }
</style>
@section('title', 'Register')
@section('content')
    <form method="POST" action="/register">
        @csrf
        <div class="form-group">
            <label for="email">
                Email address <span class="required">*</span>
            </label>
            <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror">
        </div>
        <div class="form-group">
            <label for="name">
                Your name <span class="required">*</span>
            </label>
            <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror">
        </div>
        <div class="form-group">
            <label for="password">
                Password <span class="required">*</span>
            </label>
            <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror">
        </div>
        <div class="form-group">
            <label for="password_confirmation">
                Confirm password <span class="required">*</span>
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="@error('password') is-invalid @enderror">
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

        <input type="submit" value="Register">
    </form>
@endsection
