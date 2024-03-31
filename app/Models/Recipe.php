<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $primaryKey = 'recipe_id';
    public $timestamps = false;
    protected $guarded = ['recipe_id'];
    protected $fillable = ['duration','difficulty', 'quantity'];
}
