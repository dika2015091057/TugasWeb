<?php

namespace App\Http\Controllers\User;


use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use App\Http\Controllers\Controller;
use App\Models\Update;
use App\Models\UpdateBooking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Ticket;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //TODO USER Create Booking
    public function createBooking(Request $request)
    {
        // get data from request
        //perifikasi 
        $status = Booking::where('user_id', Auth::user()->user_id)->get();
        $vehicleInput = Vehicle::where('vehicle_id', $request->vehicle_id)->first();
        $count = Booking::where('user_id', Auth::user()->user_id)->count();

        //untuk membuat booking dengan booking yang sama
        foreach ($status as $booking) {
            if ($count > 0 && $booking->status == "proses") {
                $booking_id = $booking->booking_id;
                //$statusBooking = $booking->status;
                $totalprice = $booking->price_total_booking;
                $detail_booking = DetailBooking::where('booking_id', $booking->booking_id)->get();
                foreach ($detail_booking as $data) {
                    $vehicles = Vehicle::where('vehicle_id', $data->vehicle_id)->get();                   //cek apakah admin yang punya kendaraan sama jika sama maka dibuatkan dengan id booking yang sama
                    foreach ($vehicles as $vehicle) {
                        $bookingidold = $data->booking_id;
                        if ($vehicle->admin_id == $vehicleInput->admin_id) {
                            //dd($vehicle->vehicle_id);
                            $booking_id = $bookingidold;
                            $userId = Auth::user()->user_id;
                            $status = "proses";
                            $vehicleId = $request->input('vehicle_id');
                            $qty = $request->input('qty');
                            $total = $request->input('total');
                            $pickup = $request->input('pengambilan');
                            $return = $request->input('pengembalian');

                            $detail = new DetailBooking();
                            $detail->booking_id = $booking_id;
                            $detail->vehicle_id = $vehicleId;
                            $detail->qty = $qty;
                            $detail->price_total_charter = $total;
                            $detail->pickup_date = $pickup;
                            $detail->return_date = $return;
                            $detail->save();

                            $count = $totalprice + ($detail->price_total_charter);
                            $update = UpdateBooking::where('booking_id', $booking_id)->first();
                            //dd($newBookingId);
                            // $update->price_total_booking=$count;
                            $update->update(['price_total_booking' => $count]);
                            // ];
                            $ticket = [
                                'detail_id' => $detail->id,
                            ];
                            return redirect()->route('ticket', $ticket);
                        }
                    }
                }
            }
        }

        //membuat booking baru
        $userId = Auth::user()->user_id;
        $status = "proses";
        $vehicleId = $request->input('vehicle_id');
        $qty = $request->input('qty');
        $total = $request->input('total');
        $pickup = $request->input('pengambilan');
        $return = $request->input('pengembalian');

        // create booking database
        $booking = new Booking();
        $booking->user_id = $userId;
        $booking->status = $status;
        $booking->save();

        // Mengambil ID booking yang baru ditambahkan
        $newBookingId = $booking->id;
        //create detail booking with a before created booking
        $detail = new DetailBooking();
        $detail->booking_id = $newBookingId;
        $detail->vehicle_id = $vehicleId;
        $detail->qty = $qty;
        $detail->price_total_charter = $total;
        $detail->pickup_date = $pickup;
        $detail->return_date = $return;
        $detail->save();


        $countprice = ($booking->price_total_booking) + ($detail->price_total_charter);
        $update = UpdateBooking::where('booking_id', $newBookingId)->first();
        $update->update(['price_total_booking' => $countprice]);
        $ticket = [
            'detail_id' => $detail->id,
        ];
        return redirect()->route('ticket', $ticket);
        //return response()->json(['message' => 'Booking created', 'booking_id' => $newBookingId], 201);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
