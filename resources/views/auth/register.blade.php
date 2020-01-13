@extends('layouts.index')

<style>
    .required {
        color: red;
    }
</style>

@section('content')
    <form method="POST" action="/register">
        @csrf

        <label for="email">
            Email address <span class="required">*</span>
        </label>
        <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror">

        <label for="name">
            Your name <span class="required">*</span>
        </label>
        <input id="name" type="text" name="name" class="@error('name') is-invalid @enderror">

        <label for="password">
            Password <span class="required">*</span>
        </label>
        <input id="password" type="password" name="password" class="@error('password') is-invalid @enderror">

        <label for="password_confirmation">
            Confirm password <span class="required">*</span>
        </label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="@error('password') is-invalid @enderror">

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
