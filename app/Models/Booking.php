<?php

namespace App\Models;

use App\Models\User;
use App\Models\DetailBooking;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use SoftDeletes;
    use Sortable;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'user_id',
        'price_total_booking',
        'status',
        'created_at',
        'updated_at',
    ];

    public function detail()
    {
        return $this->hasMany(DetailBooking::class, 'booking_id')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public $sortable = [
        'user_id',
        'price_total_booking',
        'status',
        'created_at',
        'updated_at',
    ];
}
