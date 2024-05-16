<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function getUser(Request $request){
        $user = User::find($request->id);
        return  $user!= null
        ? response()->json([
            "user" => $user,
        ], 200):
        response()->json([
            "message" => 'User not found'
        ], 400);
    }
}
