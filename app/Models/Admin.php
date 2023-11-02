<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $primaryKey ='admin_id';
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
