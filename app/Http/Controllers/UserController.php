<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|email:filter',
                'password'=>'required|string',
            ]);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
                return response()->json(['error'=>$error , 'status'=>'failed'],202);
                //throw $th;
        }

        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);

        return (new UserResource($user))->additional(['error'=>"" ,"Message"=>"Utilisateur enregistré", 'status'=>'done']);

    }
}
