<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MotorControlFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $motor; // This will hold the contact data

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Contact $contact
     * @return void
     */
 

    public function __construct($motor)
    {
        $this->motor = $motor;
     
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        $email = $this->subject('New Motor Controller Form Submission From GMS Website')
                      ->view('emails.motor_control_form_submitted')
                      ->with('motor', $this->motor); // Pass the contact details to the view

        // If file content is available, attach the file
     

        return $email;
    }
}
