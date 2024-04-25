<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientCategory extends Model
{
    use HasFactory;
    protected $table = 'ingredient_categories';
    protected $primaryKey = 'recipe_ingredients_id';
    public $timestamps = false;
    protected $guarded = ['recipe_ingredients_id', 'recipe_id', 'ingredient_id', 'measurement_id'];
}