<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * ログアウト用エンドポイント
     *
     * @return Response
     */
    public function logout(): Response
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
