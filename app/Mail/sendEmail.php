<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $files = public_path('image/product/54eaf93713081_-_07-germany-tuna.jpg');

        return $this->subject('Ma xac nhan mat khau')
            ->replyTo('nam.le22@student.passerellesnumeriques.org', 'Son Nam')
            ->view('email.interfaceEmail', ['data' => $this->data])
            ->attach($files);
    }
}
