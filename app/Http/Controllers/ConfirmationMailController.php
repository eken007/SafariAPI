<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfirmationMailController extends Controller
{
    public function sendEmail(){
        $details = [
            'title' => 'Votre code de vérification pour finaliser votre inscription est le :',
            'body' => request('code')
        ];

        Mail::to(request('email'))->send(new ConfirmeMail($details));

        $response = ["message" => "Mail send"];
        return response($response, 200);
    }
}
