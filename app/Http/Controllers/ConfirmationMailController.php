<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ConfirmationMailController extends Controller
{
    public function sendEmail(Request $request){
        $users= User::all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails())
        {
            $response = ["message" => "Mail incorrect"];
            return response(['errors'=>$validator->errors()->all(), $response], 422);
        }
        
        $details = [
            'title' => 'Votre code de vérification pour finaliser votre inscription est le :',
            'body' => request('code')
        ];

        Mail::to(request('email'))->send(new ConfirmeMail($details));

        $response = ["message" => "Mail send"];
        return response($response, 200);
    }
}
