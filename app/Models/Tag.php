<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;
    protected $guarded = ['tag_id'];
    protected $fillable = ['name'];
}
