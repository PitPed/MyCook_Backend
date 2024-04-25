<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'method_id';
    public $timestamps = false;
    protected $guarded = ['method_id'];
    protected $fillable = ['name'];

    public function ingredients(): HasManyThrough 
    {
        return $this->hasManyThrough(Ingredient::class, IngredientCategory::class);
    }
}
