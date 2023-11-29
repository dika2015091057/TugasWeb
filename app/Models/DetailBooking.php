<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Vehicle;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailBooking extends Model
{
    use SoftDeletes;
    use Sortable;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'detail_bookings';
    protected $primaryKey = 'detail_booking_id';
    protected $fillable = [
        'booking_id',
        'vehicle_id',
        'qty',
        'price_total_charter',
        'pickup_date',
        'return_date',
        'created_at',
        'updated_at',
        'status',
        'day'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id')->withTrashed();
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    public $sortable = [
        'booking_id',
        'vehicle_id',
        'qty',
        'price_total_charter',
        'pickup_date',
        'return_date',
        'created_at',
        'updated_at',
        'status',
        'day'
    ];
}
