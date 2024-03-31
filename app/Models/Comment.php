<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;
    protected $guarded = ['comment_id', 'date',  'user_id','post_id'];
    protected $fillable = ['body'];
    const CREATED_AT = 'date';
}
