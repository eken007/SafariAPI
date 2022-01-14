<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;



class PassportController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $request['type'] = $request['type'] ? $request['type']  : 0;
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $message = 'success';
        $response = ['token' => $token];
        return response(['user'=>$user, 'access_token'=> $response, 'message' => $message]);
    }

    public function resetpassword(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::find($id);
        $user->password = Hash::make(request('password'));
        $user->update();
        return response(['user'=>$user]);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                $message = 'success';
                return response(['user'=>$user, 'access_token'=> $response, 'message' => $message]);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function destroy ($id) {
        $user = User::find($id);
        $user->tokens()->delete();
        $user->delete();
        $users = User::select('*')->orderBy('created_at','DESC')->get();
        if($user){ 
            return response()->json($users);
        }
    }

    public function edit (Request $request) {
        $user = User::find($request->idEdit);
        if($request->statut == 'Utilisateur'){
            $user->type= 0;
        }
        if($request->statut == 'Createur'){
            $user->type= 1;
        }
        if($request->statut == 'Admin'){
            $user->type= 2;
        }

        $user->save();

        $users = User::all();
        return response()->json($users);
    }

    public function search()
    {                                
        if(request('name') == null){
            return $this->refresh();
        } else{
            $users = User::where('name','like', '%'.request('name').'%')->orderBy('created_at','DESC')->get();
            return response()->json($users);
        }
    }

    private function refresh(){
        $users = User::orderBy('created_at','DESC')->get();
        return response()->json($users);
    }
}
