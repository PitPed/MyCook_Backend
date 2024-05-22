<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function getAllIngredients(){
        $ingredients = Ingredient::orderBy('name')->get();
        return response()->json(['ingredients'=>$ingredients]);
    }
    
    public function getIngredientsLike(Request $request){
        $ingredients = Ingredient::where('name', 'LIKE', "%$request->name%")->orderBy('name')->get();
        return response()->json(['ingredients'=>$ingredients]);
    }
}
