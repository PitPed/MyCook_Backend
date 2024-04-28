<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $guarded = ['post_id', 'date',  'user_id'];
    protected $fillable = ['title', 'body'];
    const CREATED_AT = 'date';

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function images(): HasMany 
    {
        return $this->hasMany(Image::class);
    }

    public function channels(): HasMany 
    {
        return $this->hasMany(Channel::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
