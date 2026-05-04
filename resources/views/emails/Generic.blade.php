<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 10px;
                   overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .header { background: #4f46e5; color: #fff; padding: 28px 32px; }
        .header h1 { margin: 0; font-size: 20px; }
        .body { padding: 28px 32px; color: #333; line-height: 1.7; }
        .attachment { margin-top: 20px; padding: 14px 16px; background: #f5f5f5;
                      border-radius: 6px; font-size: 14px; }
        .footer { padding: 20px 32px; background: #f9fafb; color: #aaa; font-size: 12px; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>{{ $subject }}</h1>
    </div>
    <div class="body">
        {!! nl2br(e($body)) !!}

        @if($file)
            <div class="attachment">
                📎 <strong>Attachment:</strong>
                {{ $file->original_name }}
                <span style="color:#888;">({{ $file->formatted_size }})</span>
            </div>
        @endif
    </div>
    <div class="footer">Sent via Finance Tracker.</div>
</div>
</body>
</html>