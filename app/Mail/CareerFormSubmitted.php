<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $career; // This will hold the contact data

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Contact $contact
     * @return void
     */
    public $fileContent;
 
    public $fileName;
    public $fileMimeType;

    public function __construct($career, $fileContent = null, $fileName = null, $fileMimeType = null)
    {
        $this->career = $career;
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
        $email = $this->subject('New Career Form Submission From GMS Website')
                      ->view('emails.career_form_submitted')
                      ->with('career', $this->career); // Pass the contact details to the view

        // If file content is available, attach the file
        if ($this->fileContent) {
            $email->attachData($this->fileContent, $this->fileName, [
                'mime' => $this->fileMimeType,
            ]);
        }

        return $email;
    }
}
