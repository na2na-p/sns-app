<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログイン用エンドポイント
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function login(LoginRequest $request): Response
    {
        if (Auth::check()) {
            $request->session()->regenerate();
        }

        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return response(null, 200);
        }

        return response([
            'message' => 'Authentication failed',
        ], 403);
    }
}
