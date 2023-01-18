<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request): Response
    {
        if (Auth::check()) {
            return response([
                'message' => 'Already logged in',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Authentication failed',
            ], 400);
        }

        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();

            if (! Auth::user()) {
                return response([
                    'message' => 'Internal Server Error',
                ], 500);
            }

            return response([
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ], 200);
        }

        return response([
            'message' => 'Authentication failed',
        ], 400);
    }
}
