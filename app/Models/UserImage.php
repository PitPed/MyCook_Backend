<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    use HasFactory;
    protected $table = 'user_images';
    protected $primaryKey = 'user_image_id';
    public $timestamps = false;
    protected $guarded = ['user_image_id', 'user_id', 'image_id'];
    protected $fillable = ['name'];
}
