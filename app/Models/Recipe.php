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
            return round($ingredient->quantity * $ingredient->measurement->equals_to,2);
        });
        $nutritionPerPortion = [
            "calories" => 0,
            "carbohydrates" => 0,
            "sugars" => 0,
            "fat" => 0,
            "saturated" => 0,
            "protein" => 0,
            "salt" => 0
        ];

        foreach($this->recipeIngredients as $ingredient){
            $ingredientMass =  $ingredient->quantity * $ingredient->measurement->equals_to;
            $nutritionPerPortion['calories']+= $ingredient->ingredient->calories * $ingredientMass/100;
            $nutritionPerPortion['carbohydrates']+= $ingredient->ingredient->carbohydrates * $ingredientMass/100;
            $nutritionPerPortion['sugars']+= $ingredient->ingredient->sugars * $ingredientMass/100;
            $nutritionPerPortion['fat']+= $ingredient->ingredient->fat * $ingredientMass/100;
            $nutritionPerPortion['saturated']+= $ingredient->ingredient->saturated * $ingredientMass/100;
            $nutritionPerPortion['protein']+= $ingredient->ingredient->protein * $ingredientMass/100;
            $nutritionPerPortion['carbohydrates']+= $ingredient->ingredient->carbohydrates * $ingredientMass/100;
            $nutritionPerPortion['sugars']+= $ingredient->ingredient->sugars * $ingredientMass/100;
            $nutritionPerPortion['salt']+= $ingredient->ingredient->salt * $ingredientMass/100;
        }

        $this->nutritionPerPortion = $nutritionPerPortion;

        $this->nutritionPer100g = [
            "calories" => round($nutritionPerPortion['calories']/$this->totalMass*100,2),
            "carbohydrates" => round($nutritionPerPortion['carbohydrates']/$this->totalMass*100,2),
            "sugars" => round($nutritionPerPortion['sugars']/$this->totalMass*100,2),
            "fat" => round($nutritionPerPortion['fat']/$this->totalMass*100,2),
            "saturated" => round($nutritionPerPortion['saturated']/$this->totalMass*100,2),
            "protein" => round($nutritionPerPortion['protein']/$this->totalMass*100,2),
            "salt" => round($nutritionPerPortion['salt']/$this->totalMass*100,2),
        ];


        /* $this->nutritionPer100g = [
            "calories" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->calories * $mass / $this->totalMass,2);
            }),
            "carbohydrates" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->carbohydrates * $mass / $this->totalMass,2);
            }),
            "sugars" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->sugars * $mass / $this->totalMass,2);
            }),
            "fat" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->fat * $mass / $this->totalMass,2);
            }),
            "saturated" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->saturated * $mass / $this->totalMass,2);
            }),
            "protein" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->protein * $mass / $this->totalMass,2);
            }),
            "salt" => $this->recipeIngredients->sum(function ($ingredient) {
                $mass = $ingredient->quantity * $ingredient->measurement->equals_to;
                return round($ingredient->ingredient->salt * $mass / $this->totalMass,2);
            })
        ]; */
    }
}
