<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'post_votes';
    protected $primaryKey = 'post_vote_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'post_id', 'liked'];
    const CREATED_AT = 'date';

    public function post(): BelongsTo{
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
