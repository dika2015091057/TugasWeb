<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailBooking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'price_total_booking',
        'status',
        'created_at',
        'updated_at',
        ];

        public function detail(){
            return $this->hasMany(DetailBooking::class,'booking_id');
        }
        public function user(){
            return $this->belongsTo(User::class, 'user_id');
        }
}
