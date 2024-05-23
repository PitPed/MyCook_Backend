<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    protected $primaryKey = 'ingredient_id';
    public $timestamps = false;
    protected $guarded = ['ingredient_id'];
    protected $fillable = ['name', 'calories', 'carbohydrates', 'sugars', 'fat', 'saturated', 'protein', 'salt'];

    public function categories(): HasManyThrough 
    {
        return $this->hasManyThrough(Category::class, IngredientCategory::class);
    }

    public function recipes(): HasManyThrough 
    {
        return $this->hasManyThrough(Recipe::class, RecipeIngredient::class);
    }

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class, 'ingredient_id');
    }
}
