<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostChannel extends Model
{
    use HasFactory;
    protected $table = 'post_channels';
    protected $primaryKey = 'post_channel_id';
    public $timestamps = false;
    protected $guarded = ['post_channel_id', 'post_id', 'channel_id'];
    protected $fillable = ['post_id', 'channel_id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'post_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'channel_id');
    }

}
