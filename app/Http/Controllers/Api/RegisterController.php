<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' =>    'required',
            'email' =>   'required|email|unique:users',
            'password'=> 'required|min:6|confirmed',
        ]);


        $user = User::create([
            'name' =>    $request->name,
            'email' =>   $request->email,
            'password'=> bcrypt($request->password),

        ]);

        return response()->json($user, 201);

    }
}
