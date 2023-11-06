<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Carbon;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //TODO View All Vehicles
    public function viewvehicles()
    {
        $vehicle = vehicle::get();
        return $vehicle;
    }
    public function viewVehicleWithId(Request $request)
    {
        $id = $request->input('vehicle_id');
        dd($id);
        $vehicle = vehicle::where('vehicle_id', $id)->get();
        return $vehicle;
    }

    //TODO USER Create Booking
    public function createBooking(Request $request)
    {
        // get data from request
        $userId = $request->input('user_id');
        $status = "proses";
        $vehicleId = $request->input('vehicle_id');
        $qty = $request->input('qty');        
        $total = $request->input('total');        
        $pickup = $request->input('pickup_date');        
        $return = $request->input('return_date');        
        

// Mengonversi tanggal ke format timestamp

// $dateString = '13/02/2022';
// dd($pickup,$dateString);
// Mengonversi tanggal ke format Carbon yang dapat diuraikan
// $carbonDate = Carbon::createFromFormat('d/m/Y', $pickup);

        // // Membuat objek Booking dan menyimpannya ke database
        // create booking database
        $booking = new Booking();
        $booking->booking_id;
        $booking->user_id = $userId;
        $booking->status = $status;
        $booking->save();

        // Mengambil ID booking yang baru ditambahkan
        $newBookingId = $booking->id;
        // $newBookingId = DB::table('bookings')->insertGetId([
        //     'user_id' => $userId,
        //     'status' => $status,
        //     'created_at' =>now()
        // ]);
        
        //create detail booking with a before created booking
        $detail = new DetailBooking();
        $detail->booking_id=$newBookingId;
        $detail->vehicle_id=$vehicleId;
        $detail->qty=$qty;
        $detail->price_total_charter=$total;
        $detail->pickup_date=$pickup;
        $detail->return_date=$return;
        $detail->save();
        
return ($detail);
       //return response()->json(['message' => 'Booking created', 'booking_id' => $newBookingId], 201);
    }


    //TODO Update Booking
public function updateBooking(){

}

}
