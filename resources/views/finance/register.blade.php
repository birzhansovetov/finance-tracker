@extends('layouts.app')

@section('content')
<div class="card" style="max-width:600px; margin:auto;">
    <h2>{{ __('app.register_page') }}</h2>

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <label>{{ __('app.full_name') }}</label>
        <input type="text" name="name" required>

        <label>{{ __('app.email') }}</label>
        <input type="email" name="email" required>

        <label>{{ __('app.password') }}</label>
        <input type="password" name="password" required>

        <label>{{ __('app.confirm_password') }}</label>
        <input type="password" name="password_confirmation" required>

        <label class="checkbox-label">
    <input type="checkbox" name="terms" required>
    <span>{{ __('app.accept_terms') }}</span>
    </label>

        <button class="btn">{{ __('app.register') }}</button>
    </form>
</div>
@endsection