<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $primaryKey = 'recipe_id';
    public $timestamps = false;
    protected $guarded = ['recipe_id'];
    protected $fillable = ['duration','difficulty', 'quantity'];

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    public function ingredients(): HasManyThrough 
    {
        return $this->hasManyThrough(Ingredient::class, RecipeIngredient::class);
    }
}
