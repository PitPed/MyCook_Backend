<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use Illuminate\Http\Request;
use App\Models\Method;

class GeneralController extends Controller
{
    // Obtener todos los métodos disponibles
    public function getAllMethods(){
        $methods = Method::orderBy('name')->get();
        return response()->json(['methods'=>$methods]);
    }
    
    // Obtener métodos que coinciden con un nombre dado
    public function getMethodsLike(Request $request){
        $methods = Method::where('name', 'LIKE', "%$request->name%")->orderBy('name')->get();
        return response()->json(['methods'=>$methods]);
    }

    // Obtener todas las mediciones disponibles
    public function getAllMeasurements(){
        $measurements = Measurement::orderBy('name')->get();
        return response()->json(['measurements'=>$measurements]);
    }
    
}
