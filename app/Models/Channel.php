<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $primaryKey = 'channel_id';
    public $timestamps = false;
    protected $guarded = ['channel_id'];
    protected $fillable = ['name', 'is_public', 'open_posting'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function users(): HasManyThrough 
    {
        return $this->hasManyThrough(User::class, Member::class);
    }
}
