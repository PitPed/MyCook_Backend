<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Method;

class MethodController extends Controller
{
    public function getAllMethods(){
        $methods = Method::orderBy('name')->get();
        return response()->json(['methods'=>$methods]);
    }
    
    public function getMethodsLike(Request $request){
        $methods = Method::where('name', 'LIKE', "%$request->name%")->orderBy('name')->get();
        return response()->json(['methods'=>$methods]);
    }
    
}
