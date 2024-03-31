<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $guarded = ['post_id', 'date',  'user_id','recipe_id'];
    protected $fillable = ['duration','title', 'body'];
    const CREATED_AT = 'date';
}
