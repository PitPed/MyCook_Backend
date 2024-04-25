<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeTag extends Model
{
    use HasFactory;
    protected $table = 'recipe_tags';
    protected $primaryKey = 'recipe_tags_id';
    public $timestamps = false;
    protected $guarded = ['recipe_tags_id', 'recipe_id', 'tag_id'];
}
