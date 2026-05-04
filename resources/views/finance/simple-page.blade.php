@extends('layouts.app')

@section('content')
<div class="card">
    <h2>{{ __($title) }}</h2>
    <p>{{ __($description) }}</p>
</div>
@endsection