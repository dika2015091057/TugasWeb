<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'email',
        'username',
        'password',
        'address',
        'phone_number',
        'photo_profile',
        'created_at',
        'updated_at'
    ];
}
