<?php

namespace App\Mail;

use App\Models\UserFile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FileUploadedMail extends Mailable
{
    use Queueable, SerializesModels;

   public UserFile $file;

public function __construct(UserFile $file)
{
    $this->file = $file;
}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your file has been uploaded: ' . $this->file->original_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.fileupload',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromStorageDisk('local', $this->file->path)
                ->as($this->file->original_name)
                ->withMime($this->file->mime_type),
        ];
    }
}