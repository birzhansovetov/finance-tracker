<?php

namespace App\Mail;

use App\Models\UserFile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    // No type on $subject — parent Mailable declares it without a type
    public $subject;
    public $body;
    public $file;

    public function __construct(
        string    $subject,
        string    $body,
        ?UserFile $file = null,
    ) {
        $this->subject = $subject;
        $this->body    = $body;
        $this->file    = $file;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.Generic');
    }

    public function attachments(): array
    {
        if (!$this->file) return [];

        return [
            Attachment::fromStorageDisk('local', $this->file->path)
                ->as($this->file->original_name)
                ->withMime($this->file->mime_type),
        ];
    }
}