@extends('layouts.app')

@section('content')
<div class="hero">
    <h2>{{ __('app.welcome_title') }}</h2>
    <p>{{ __('app.welcome_text') }}</p>
    <p>{{ __('app.track_text') }}</p>

    <a href="{{ route('register') }}" class="btn">{{ __('app.register') }}</a>
    <a href="{{ route('login') }}" class="btn">{{ __('app.login') }}</a>
</div>

<div class="card">
    <h3>{{ __('app.who_use') }}</h3>
    <ul>
        <li>{{ __('app.use_students') }}</li>
        <li>{{ __('app.use_employees') }}</li>
        <li>{{ __('app.use_freelancers') }}</li>
        <li>{{ __('app.use_goals') }}</li>
        <li>{{ __('app.use_budgeting') }}</li>
    </ul>
</div>

<div class="card">
    <h3>{{ __('app.project_pages') }}</h3>
    <div class="grid-links">
        <a class="btn" href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a>
        <a class="btn" href="{{ route('transactions.add') }}">{{ __('app.add_transaction') }}</a>
        <a class="btn" href="{{ route('transactions.history') }}">{{ __('app.transactions') }}</a>
        <a class="btn" href="{{ route('categories') }}">{{ __('app.categories') }}</a>
        <a class="btn" href="{{ route('budgets') }}">{{ __('app.budgets') }}</a>
        <a class="btn" href="{{ route('analytics') }}">{{ __('app.analytics') }}</a>
        <a class="btn" href="{{ route('goals.savings') }}">{{ __('app.goals') }}</a>
        <a class="btn" href="{{ route('subscriptions') }}">{{ __('app.subscriptions') }}</a>
        <a class="btn" href="{{ route('income.sources') }}">{{ __('app.income_sources') }}</a>
        <a class="btn" href="{{ route('reports') }}">{{ __('app.reports') }}</a>
        <a class="btn" href="{{ route('notifications') }}">{{ __('app.notifications') }}</a>
        <a class="btn" href="{{ route('profile') }}">{{ __('app.profile') }}</a>
        <a class="btn" href="{{ route('settings.security') }}">{{ __('app.settings') }}</a>
        <a class="btn" href="{{ route('support.faq') }}">{{ __('app.support') }}</a>
    </div>
</div>
@endsection