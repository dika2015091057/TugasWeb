<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\DetailBooking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    protected $primaryKey = 'vehicle_id';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'admin_id',
        'name',
        'stock',
        'type',
        'charter_price',
        'status',
        'description',
        'created_at',
        'updated_at',
        'vehicle_photo',
    ];

    public function admin()
    {
        return  $this->belongsTo(Admin::class, 'admin_id')->withTrashed();
    }

    public function detail()
    {
        return $this->hasMany(DetailBooking::class, 'vehicle_id')->withTrashed();
    }
    public $sortable = [
        'admin_id',
        'name',
        'stock',
        'type',
        'charter_price',
        'status',
        'description',
        'created_at',
        'updated_at',
        'vehicle_photo',
    ];
}
