<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;
    protected $table = 'recipe_steps';
    protected $primaryKey = 'recipe_steps_id';
    public $timestamps = false;
    protected $guarded = ['recipe_steps_id', 'recipe_id', 'step_id'];
}
