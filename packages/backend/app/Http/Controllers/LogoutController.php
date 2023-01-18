<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(): Response|Application|ResponseFactory
    {
        if (! Auth::check()) {
            return response([
                'message' => 'ログインしていません',
            ], 400);
        }

        Auth::logout();

        return response(null, 200);
    }
}
