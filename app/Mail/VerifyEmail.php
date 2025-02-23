<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // return $this->subject('Email Verification')
        // ->view('emails.verify')
        // ->with([
        //     'verificationUrl' => route('verify.email', ['token' => $this->user->verification_token])
        // ]);
        return $this->subject('E-posta Doğrulama')->view('emails.verify');
    }
}
