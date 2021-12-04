<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmationMailController extends Controller
{
    public function sendEmail(){
        $details = [
            'title' => 'Mail from media',
            'body' => 'this is for testing mail using mail'
        ];

        Mail::to("ekenfranky@gmail.com")->send(new ConfirmeMail($details));

        $response = ["message" => "Mail send"];
        return response($response, 200);
    }
}
