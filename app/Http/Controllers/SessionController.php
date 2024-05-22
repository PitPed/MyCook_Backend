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

        return response()->json(
            [   'message' => 'Login correcto',
                'session' => session()->getId(),
                'user'=> Session::get('user')], 200);

    }

    public function register(Request $request)
    {
        if (!isset($request->username) || !isset($request->email) || !isset($request->password)) {
            return response()->json(['message' => 'Se deben rellenar todos los campos'], 400);
        }

        if(User::where('name', '=', $request->username)->orWhere('email', '=', $request->email)->count()>0){
            return response()->json(['message' => 'Ya existe un usuario con ese nombre o email'], 400);
        }

        $badRegister = response()->json(['message' => 'No se ha podido crear el usuario'], 400);

        $user = User::create([
            'name'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        if($user->save()){
            $request->session()->put('user', $user->user_id);
            return response()->json(
                [   'message' => 'El usuario ha sido creado',
                    'session' => session()->getId(),
                    'user'=> Session::get('user')], 200);
        }else{
            return $badRegister;
        }
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
