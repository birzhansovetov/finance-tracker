@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto;">
    <h2>{{ __('app.login_page') }}</h2>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <label>{{ __('app.email') }}</label>
        <input type="email" name="email" placeholder="{{ __('app.email') }}" required>

        <label>{{ __('app.password') }}</label>
        <input type="password" name="password" placeholder="{{ __('app.password') }}" required>

        <div class="remember-block">
    <label class="remember-label">
        <input type="checkbox" name="remember">
        <span>{{ __('app.remember_me') }}</span>
    </label>
<div class="form-actions">
    <button type="submit" class="btn">{{ __('app.login') }}</button>

    <a href="{{ route('forgot.password') }}" class="btn">
        {{ __('app.forgot_password') }}
    </a>
</div>
@endsection