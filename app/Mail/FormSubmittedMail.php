<?php

namespace App\Mail;

use App\Models\FormModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class FormSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public FormModel $form;
    public $rocnik;
    protected array $attachmentPaths; // Array of file paths for attachments
    /**
     * Create a new message instance.
     */
    public function __construct($formData, $attachmentPaths, $rocnik)
    {
        $this->form = $formData;
        $this->rocnik = $rocnik;
        $this->attachmentPaths = $attachmentPaths;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Potvrzení o přihlášce',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
            with: [
                'form' => $this->form,
                'rocnik' => $this->rocnik,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return collect($this->attachmentPaths)->map(function ($path) {
            return Attachment::fromPath($path)
                             ->as(basename($path)) // Use the file's base name for attachment
                             ->withMime('application/pdf'); // Adjust MIME type if necessary
        })->toArray();
    }
    public function build(){
        return $this->markdown('emails.prihlaska_email');
    }
}
