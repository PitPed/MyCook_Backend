<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Measurement;
use Illuminate\Database\Eloquent\Relations\HasOne;


class RecipeIngredient extends Model
{ 
    use HasFactory;
    protected $table = 'recipe_ingredients';
    protected $primaryKey = 'recipe_ingredient_id';
    public $timestamps = false;
    protected $guarded = ['recipe_ingredient_id', 'recipe_id', 'ingredient_id', 'measurement_id', 'quantity'];
    protected $fillable = ['quantity'];

    /*
    Revisar, es belongs?
    */

    public function ingredient(): HasOne
    {
        return $this->hasOne(Ingredient::class, 'ingredient_id');
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function measurement(): HasOne
    {
        return $this->hasOne(Measurement::class, 'measurement_id');
    }
}