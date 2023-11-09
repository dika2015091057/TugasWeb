<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailBooking extends Model
{
    use HasFactory;
    protected $table = 'detail_bookings';
    protected $primaryKey = 'detail_booking_id';
    protected $fillable =[
        'booking_id',
        'vehicle_id',
        'qty',
        'price_total_charter',
        'pickup_date',
        'return_date',
        'created_at',
        'updated_at'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }
}
