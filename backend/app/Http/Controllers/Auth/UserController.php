<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return response([
            "user" => $request->user()
        ], ResponseAlias::HTTP_OK);
    }
}
