<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        //Validate the request
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);


        //Recieve the request
        $name     = $request->input('name');
        $email    = $request->input('email');
        $password = $request->input('password');


        // User Array will be passed to the response
        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'signin' => [
                'href' => 'api/v1/user/signin',
                'method' => 'POST',
                'params' => 'email, password'
            ]
        ];

        $response = [
            'msg' => 'User created',
            'user' => $user
        ];

        return response()->json($response, 200);
    }


    public function signin(Request $request)
    {
         //Validate the request
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Recieve the request
        $email    = $request->input('email');
        $password = $request->input('password');

        // User Array will be passed to the response
        $user = [
            'name' => 'Name',
            'email' => $email,
            'password' => $password
        ];

        $response = [
            'msg' => 'User signed in',
            'user' => $user
        ];

        return response()->json($response, 200);

    }


}
