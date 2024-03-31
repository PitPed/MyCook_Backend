<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    protected $primaryKey = 'ingredient_id';
    public $timestamps = false;
    protected $guarded = ['ingredient_id'];
    protected $fillable = ['name', 'calories', 'carbohydrates', 'sugars', 'fat', 'saturated', 'protein', 'salt'];

}
