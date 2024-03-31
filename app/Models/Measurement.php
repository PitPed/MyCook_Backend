<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    protected $table = 'measurements';
    protected $primaryKey = 'measurement_id';
    public $timestamps = false;
    protected $guarded = ['measurement_id'];
    protected $fillable = ['name', 'type'];
}
