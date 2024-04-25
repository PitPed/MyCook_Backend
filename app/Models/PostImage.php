<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $table = 'post_images';
    protected $primaryKey = 'post_image_id';
    public $timestamps = false;
    protected $guarded = ['post_image_id', 'post_id', 'image_id'];
}
