<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ResetPasswordMailController extends Controller
{
    public function sendEmail(Request $request){

        $users= User::all();
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);
        foreach($users as $user){
            if(request('email') == $user->email){
                $details = [
                    'title' => 'Votre code de vérification pour renitialiser votre mot de passe est le :',
                    'body' => request('code')
                ];
        
                Mail::to(request('email'))->send(new ResetPasswordMail($details));
        
               return response()->json($user); 
            } else {
                $response = ["message" => "Email no exist"];
                return response(['errors'=>'erreur', $response], 422);
            }
        }
        if ($validator->fails())
        {
            $response = ["message" => "Mail incorrect"];
            return response(['errors'=>$validator->errors()->all(), $response], 422);
        }
    }
}
