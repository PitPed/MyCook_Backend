<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Measurement;


class RecipeIngredient extends Model
{ 
    use HasFactory;
    protected $table = 'recipe_ingredients';
    protected $primaryKey = 'recipe_ingredient_id';
    public $timestamps = false;
    protected $guarded = ['recipe_ingredient_id', 'recipe_id', 'ingredient_id', 'measurement_id'];
    protected $fillable = ['quantity'];

    /*
    Revisar, es belongs?
    */

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class, 'recipe_id');
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}