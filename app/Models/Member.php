<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $timestamps = false;
    protected $guarded = ['member_id', 'user_id', 'group_id'];
    protected $fillable = ['rol'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class);
    }
}
