<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $primaryKey = 'menu_id';
    public $timestamps = false;
    protected $guarded = ['menu_id', 'user_id'];
    protected $fillable = ['name'];

    public function menuRecipes(): HasMany 
    {
        return $this->hasMany(MenuRecipes::class);
    }

    public function recipes(): HasManyThrough 
    {
        return $this->hasManyThrough(Recipe::class, MenuRecipes::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
