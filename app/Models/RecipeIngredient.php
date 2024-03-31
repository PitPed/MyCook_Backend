<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{ 
    use HasFactory;
    protected $table = 'recipe_ingredients';
    protected $primaryKey = 'recipe_ingredient_id';
    public $timestamps = false;
    protected $guarded = ['recipe_ingredient_id', 'recipe_id', 'ingredient_id', 'measurement_id', 'quantity'];
}