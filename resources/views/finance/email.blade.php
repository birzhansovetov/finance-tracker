@extends('layouts.app')

@section('content')
<div class="card" style="max-width:700px; margin:auto;">
    <h2>✉️ {{ __('app.send_email') }}</h2>

    <a href="{{ route('files.index') }}" class="btn email-btn">
        📁 {{ __('app.my_files') }}
    </a>

    <form method="POST" action="{{ route('email.store') }}">
        @csrf

        <h3>{{ __('app.compose_message') }}</h3>

        <label>{{ __('app.to') }}</label>
        <input type="email" name="to" placeholder="recipient@example.com" required>

        <label>{{ __('app.subject') }}</label>
        <input type="text" name="subject" required>

        <label>{{ __('app.message') }}</label>
        <textarea name="body" rows="6" placeholder="{{ __('app.write_message') }}" required></textarea>

        <label>{{ __('app.attach_file') }}</label>
        <select name="file_id">
            <option value="">{{ __('app.no_attachment') }}</option>

            @foreach($files as $file)
                <option value="{{ $file->id }}">
                    {{ $file->original_name }}
                </option>
            @endforeach
        </select>

        <div class="form-actions">
    <button type="submit" class="btn">
        📩 {{ __('app.send_email') }}
    </button>

    <a href="{{ route('landing') }}" class="btn">
        {{ __('app.cancel') }}
    </a>
</div>
    </form>
</div>
@endsection