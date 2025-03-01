<?php

namespace App\Mail;

use App\Models\Support;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncomingSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    public function __construct(Support $support)
    {
        $this->support = $support;
    }

    public function build()
    {
        // return $this->subject('Email Verification')
        // ->view('emails.verify')
        // ->with([
        //     'verificationUrl' => route('verify.email', ['token' => $this->user->verification_token])
        // ]);
        return $this->subject('Destek Talebi')->view('emails.incoming_support');
    }
}
