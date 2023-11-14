<?php

namespace App\Models;


use App\Models\Role;
use App\Models\Vehicle;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $primaryKey ='admin_id';
    protected $dates = ['deleted_at'];
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
        return $this->belongsTo(Role::class,'role_id')->withTrashed();
    }
    public function vehicle(){
        return $this->hasMany(Vehicle::class,'admin_id')->withTrashed();
    }
}
