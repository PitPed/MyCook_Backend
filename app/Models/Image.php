<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'image_id';
    public $timestamps = false;
    protected $guarded = ['image_id'];
    protected $fillable = ['url','alt'];
}
