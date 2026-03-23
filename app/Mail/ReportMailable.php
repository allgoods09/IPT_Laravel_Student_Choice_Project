<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;
    public $subject;
    public $type;

    public function __construct($pdfContent, $subject, $type = 'report')
    {
        $this->pdfContent = $pdfContent;
        $this->subject = $subject;
        $this->type = $type;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.report',
        );
    }

    public function attachments(): array
    {
        return [
            [
                'content' => $this->pdfContent,
                'mime' => 'application/pdf',
                'as' => $this->type . '_report.pdf',
            ],
        ];
    }
}

