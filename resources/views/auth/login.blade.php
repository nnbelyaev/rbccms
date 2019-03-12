@extends('layouts.app')

@section('content')

    <h1 class="title">{{ __('Login') }}</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label class="label">{{ __('E-Mail Address') }}</label>
            <div class="control">
                <input name="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" value="{{ old('email') }}" required autofocus>
            </div>
            @if ($errors->has('email'))
                <p class="help is-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>
        <div class="field">
            <label class="label">{{ __('Password') }}</label>
            <div class="control">
                <input name="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" value="" required>
            </div>
            @if ($errors->has('password'))
                <p class="help is-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">{{ __('Login') }}</button>
            </div>
            @if (Route::has('password.request'))
                <div class="control">
                    <a href="{{ route('password.request') }}" class="button is-text">{{ __('Forgot Your Password?') }}</a>
                </div>
            @endif
        </div>
    </form>
@endsection
