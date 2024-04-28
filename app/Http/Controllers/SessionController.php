<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function isLogged(Request $request)
    {
        return response()->json([
            "isLogged" => $request->session()->has('user'),
            'session' => session()->getId(),
            'user'=> Session::get('user')
        ], 200);
    }

    public function login(Request $request)
    {
        //User::where('username', 'admin')->update(array('password' => Hash::make('1234')));
        if (!isset($request->username) || !isset($request->password)) {
            return response()->json(['message' => 'Se deben propocionar un usuario y una contraseña'], 400);
        }

        $badLogin = response()->json(['message' => 'Usuario o contraseña incorrectos'], 400);

        $user = User::where('name', "=", $request->username)->first();

        if (empty($user)) {
            return $badLogin;
        }

        if (!Hash::check($request->password, $user->password)) {
            return $badLogin;
        }

        $request->session()->put('user', $user->user_id);

        $now = new \DateTime('now');
        return response()->json(
            [   'message' => 'Login correcto', 'date' => $now->format('d-M-Y H:i:s'),
                'session' => session()->getId(),
                'user'=> Session::get('user')], 200);

    }

    public function logout(Request $request)
    {
        $request->session()->pull('user', $request->id_usuario);
        return response()->json(['message' => 'La sesión se ha cerrado'], 200);
    }

    public function createAdmin(){
        $admin = new User([
            "name"=>"admin",
            "email"=>"admin@email.mail",
            "password"=>Hash::make('1234')
        ]);
        $admin->save();
        return response()->json(['message' => 'Admin generado'], 200);

    }
}
