<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Step extends Model
{
    use HasFactory;
    protected $table = 'steps';
    protected $primaryKey = 'step_id';
    public $timestamps = false;
    protected $guarded = ['step_id', 'title', 'description', 'time', '', ''];
    protected $fillable = ['name'];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function methods(): BelongsToMany
    {
        return $this->belongsToMany(Method::class);
    }
}