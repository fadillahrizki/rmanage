@extends('layouts.app')
@section('title','Register')
@section('content')
<div class="container">
    <div class="row">
        <div class="col m12 l6 offset-l3">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Register') }}</div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="input-field">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="input-field">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="input-field">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="validate" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="input-field">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="validate" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn purple waves-effect">{{ __('Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
