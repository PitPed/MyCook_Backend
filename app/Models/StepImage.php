<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepImage extends Model
{
    use HasFactory;
    protected $table = 'step_images';
    protected $primaryKey = 'step_image_id';
    public $timestamps = false;
    protected $guarded = ['step_image_id', 'step_id', 'image_id'];
}
