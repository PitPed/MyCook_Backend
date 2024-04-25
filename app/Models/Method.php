<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Method extends Model
{
    use HasFactory;
    protected $table = 'methods';
    protected $primaryKey = 'method_id';
    public $timestamps = false;
    protected $guarded = ['method_id'];
    protected $fillable = ['name'];

    public function steps(): BelongsToMany
    {
        return $this->belongsToMany(Step::class);
    }
}