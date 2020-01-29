@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="container">
    <div class="row">
        <div class="col m12 l6 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Login') }}</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-field">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="validate" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <p>
                            <label>
                                <input type="checkbox" class="filled-in" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember Me</span>
                            </label>
                        </p>

                        <button type="submit" class="btn purple waves-effect">{{ __('Login') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
