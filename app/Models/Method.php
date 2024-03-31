<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $table = 'methods';
    protected $primaryKey = 'method_id';
    public $timestamps = false;
    protected $guarded = ['method_id'];
    protected $fillable = ['name'];
}
