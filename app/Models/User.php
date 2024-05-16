<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $guarded = ['user_id'];
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function posts(): HasMany 
    {
        return $this->hasMany(Post::class);
    }

    public function members(): HasMany 
    {
        return $this->hasMany(Post::class);
    }

    public function channels(): HasManyThrough 
    {
        return $this->hasManyThrough(Channel::class, Member::class);
    }
}