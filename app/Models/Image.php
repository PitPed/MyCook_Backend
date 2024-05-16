<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $primaryKey = 'image_id';
    public $timestamps = false;
    protected $guarded = ['image_id'];
    protected $fillable = ['url','alt'];

    public function postImage(): BelongsTo{
        return $this->belongsTo(PostImage::class);
    }
}
