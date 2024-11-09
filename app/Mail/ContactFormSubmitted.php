<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $contact; // This will hold the contact data

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Contact $contact
     * @return void
     */
    public $fileContent;
 
    public $fileName;
    public $fileMimeType;

    public function __construct($contact, $fileContent = null, $fileName = null, $fileMimeType = null)
    {
        $this->contact = $contact;
        $this->fileContent = $fileContent;
        $this->fileName = $fileName;
        $this->fileMimeType = $fileMimeType;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        $email = $this->subject('New Contact Form Submission From GMS Website')
                      ->view('emails.contact_form_submitted')
                      ->with('contact', $this->contact); // Pass the contact details to the view

        // If file content is available, attach the file
        if ($this->fileContent) {
            $email->attachData($this->fileContent, $this->fileName, [
                'mime' => $this->fileMimeType,
            ]);
        }

        return $email;
    }
}
