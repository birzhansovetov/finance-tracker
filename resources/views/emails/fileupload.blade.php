<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 10px;
                   overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .header { background: #4f46e5; color: #fff; padding: 28px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 28px 32px; }
        .detail-row { display: flex; padding: 8px 0; border-bottom: 1px solid #f0f0f0; }
        .detail-label { color: #888; font-size: 12px; text-transform: uppercase;
                        width: 120px; flex-shrink: 0; padding-top: 2px; }
        .detail-value { font-weight: 600; color: #333; }
        .footer { padding: 20px 32px; background: #f9fafb; color: #aaa; font-size: 12px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>{{ __('app.file_uploaded') }}</h1>
    </div>

    <div class="body">
        <p>{{ __('app.hi') }} <strong>{{ $file->user->name }}</strong>,</p>

        <p>{{ __('app.upload_success') }}</p>

        <div style="margin: 20px 0;">
            <div class="detail-row">
                <span class="detail-label">{{ __('app.file_name') }}</span>
                <span class="detail-value">{{ $file->original_name }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">{{ __('app.size') }}</span>
                <span class="detail-value">{{ $file->formatted_size }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">{{ __('app.type') }}</span>
                <span class="detail-value">{{ $file->mime_type }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">{{ __('app.uploaded_at') }}</span>
                <span class="detail-value">{{ $file->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <p>{{ __('app.manage_files_text') }}</p>
    </div>

    <div class="footer">
        {{ __('app.auto_notification') }}
    </div>
</div>
</body>
</html>