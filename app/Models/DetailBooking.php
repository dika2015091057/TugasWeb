<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;
    protected $table = 'detail_bookings';
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
}
