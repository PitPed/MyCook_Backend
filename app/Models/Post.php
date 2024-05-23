<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $guarded = ['post_id', 'date'];
    protected $fillable = ['user_id', 'title', 'body', 'user', 'votes','voted'];
    const CREATED_AT = 'date';

    public function recipe(): HasOne{
        return $this->hasOne(Recipe::class, 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function postImages(): HasMany
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function images(): HasManyThrough
    {
        return $this->hasManyThrough(Image::class,PostImage::class, 'post_id', 'image_id');
    }

    public function postChannels()
    {
        return $this->hasMany(PostChannel::class, 'post_id', 'post_id');
    }

    public function channels()
    {
        return $this->hasManyThrough(Channel::class, PostChannel::class, 'post_id', 'channel_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function votesRelation(): HasMany
    {
        return $this->hasMany(Vote::class, 'post_id');
    }

    public function votesNumber():int{
        return $this->votesRelation()->where('liked', '=',true)->count() - $this->votesRelation()->where('liked', '=',false)->count();
    }
}
