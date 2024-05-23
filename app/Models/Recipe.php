<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $primaryKey = 'recipe_id';
    public $timestamps = false;
    protected $guarded = ['recipe_id'];
    protected $fillable = ['duration','difficulty', 'quantity', 'recipeIngredients'];

    public function post(): BelongsTo{
        return $this->belongsTo(Post::class);
    }


    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class, 'recipe_id');
    }

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class, 'recipe_id');
    }

    public function ingredients(): HasManyThrough 
    {
        return $this->hasManyThrough(Ingredient::class, RecipeIngredient::class, 'recipe_id', 'ingredient_id');
    }

    public function calculateNutrition(){
        $this->totalMass = $this->recipeIngredients->sum(function ($ingredient) {
            return $ingredient->quantity * $ingredient->measurement->equals_to;
        });
        $this->nutritionPer100g = [
            "calories" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->calories * $mass / $this->totalMass;
            }),
            "carbohydrates" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->carbohydrates * $mass / $this->totalMass;
            }),
            "sugars" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->sugars * $mass / $this->totalMass;
            }),
            "fat" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->fat * $mass / $this->totalMass;
            }),
            "saturated" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->saturated * $mass / $this->totalMass;
            }),
            "protein" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->protein * $mass / $this->totalMass;
            }),
            "salt" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return $ingredient->ingredient->salt * $mass / $this->totalMass;
            })
        ];
        
    }
}
