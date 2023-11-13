<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller {
    //TODO View Bookings
    public function view(){
        $admin_id = Auth::user()->admin_id;

        $sum = Vehicle::where('admin_id',$admin_id)->sum('stock');

        $bookings = Booking::whereHas('detail.vehicle', function($query) use ($admin_id) {
            $query->where('admin_id', $admin_id);
        })->with('detail','user')->paginate(5);
    
        
        return view('admin.booking', compact('bookings','sum'));


}
}