<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $primaryKey = 'channel_id';
    public $timestamps = false;
    protected $guarded = ['channel_id'];
    protected $fillable = ['name', 'is_public', 'open_posting'];
}
