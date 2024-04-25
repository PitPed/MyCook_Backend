<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostChannel extends Model
{
    use HasFactory;
    protected $table = 'post_channels';
    protected $primaryKey = 'post_channel_id';
    public $timestamps = false;
    protected $guarded = ['post_channel_id', 'post_id', 'channel_id'];
}
