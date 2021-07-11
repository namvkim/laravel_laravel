<?php

namespace App\Http\Controllers;

use App\Mail\sendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class emailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = $request->txtEmail;

        $data = [
            'title' => 'Mat khau cua ban la: ',
            'body' => '123456',
        ];

        Mail::to($email)->send(new sendEmail($data));
        Session::flash('message', 'Send email successfully!');

        return view('email.inputEmail');

    }
}
