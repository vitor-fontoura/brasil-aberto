<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialiteAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_user_id',
        'provider',
        'nickname',
        'name',
        'email',
        'avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
