<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public function admin(){
        return $this->belongsTo(Role::class,'role_id');
    }
    public function vehicle(){
        return $this->hasMany(Vehicle::class,'admin_id');
    }
}
