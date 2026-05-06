@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>📬 {{ __('app.sent_emails') }}</h2>

    <a href="{{ route('email.create') }}" class="btn">
        ✉️ {{ __('app.send_email') }}
    </a>

    <div class="card" style="margin-top: 20px;">
        @if($emails->isEmpty())
            <p>{{ __('app.no_sent_emails') }}</p>
        @else
            <table style="width:100%;">
                <thead>
    <tr>
        <th>{{ __('app.to') }}</th>
        <th>{{ __('app.subject') }}</th>
        <th>{{ __('app.message') }}</th>
        <th>{{ __('app.sent_at') }}</th>
    </tr>
</thead>
<tbody>
    @foreach($emails as $email)
        <tr>
            <td>{{ $email->to }}</td>
            <td>{{ $email->subject }}</td>
            <td>{{ $email->body }}</td>
            <td>{{ $email->created_at->format('d M Y, H:i') }}</td>
        </tr>
    @endforeach
</tbody>
            </table>
        @endif
    </div>
</div>
@endsection