@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        @include('validationErrorMessage')
        <form action="/user/auth/sign-in" method="post">
            <label>
                Email:
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </label>
            <label>
                Password:
                <input type="password" name="password" placeholder="password" value="{{ old('password') }}">
            </label>

            <button type="submit">Submit</button>
            {!! csrf_field() !!}
        </form>
    </div>
@endsection
