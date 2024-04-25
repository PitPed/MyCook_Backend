<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuRecipe extends Model
{
    use HasFactory;
    protected $table = 'menu_recipes';
    protected $primaryKey = 'menu_recipes_id';
    public $timestamps = false;
    protected $guarded = ['menu_recipes_id', 'menu_id', 'recipe_id'];
    protected $fillable = ['day', 'meal'];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
