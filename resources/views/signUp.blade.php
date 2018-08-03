@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('validationErrorMessage')
        <form action="/user/auth/sign-up" method="post">
            <label>
                NicName:
                <input type="text" name="nickname" placeholder="Nickname" value="{{ old('nickname') }}">
            </label>
            <label>
                Email:
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </label>
            <label>
                Password:
                <input type="password" name="password" placeholder="Password" value="{{ old('password') }}">
            </label>
            <label>
                Confirm Password:
                <input type="password" name="password_confirmation" placeholder="Password" value="{{ old('password_confirmation') }}">
            </label>
            <label>
                Account type:
                <select name="type">
                    <option value="A">Admin</option>
                    <option value="G">Guest</option>
                </select>
            </label>

            <button type="submit">Submit</button>
            {!! csrf_field() !!}
        </form>

    </div>


@endsection