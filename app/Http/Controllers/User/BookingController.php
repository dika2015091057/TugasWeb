<?php

namespace App\Http\Controllers\User;


use App\Models\Update;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use App\Models\UpdateBooking;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                            $update = Booking::where('booking_id', $booking_id)->first();
                            //dd($newBookingId);
                            // $update->price_total_booking=$count;
                            $update->update(['price_total_booking' => $count]);
                            // ];

                            // $ticket =DetailBooking::where('booking_id',$booking_id)->get();
                            // //return redirect()->route('ticket', $ticket);


                            // Melakukan redirect ke route baru
                            return redirect()->route('ticket',$booking_id);
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
        $newBookingId = $booking->booking_id;
        //dd($newBookingId);
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
        $update = Booking::where('booking_id', $newBookingId)->first();
        $update->update(['price_total_booking' => $countprice]);
        $ticket = [
            'booking_id' => $newBookingId,
        ];
        return redirect()->route('ticket', $ticket);
        //return response()->json(['message' => 'Booking created', 'booking_id' => $newBookingId], 201);
    }



    //TODO Booking Details
    public function bookings()
    {
        $userId = Auth::user()->user_id;

        // $booking = Booking::with('detail')->where('user_id', $userId)->get();

        // $details = DB::table('detail_bookings')
        // ->leftJoin('bookings', 'detail_bookings.booking_id', '=', 'bookings.booking_id')
        // ->where('bookings.user_id',$userId)
        // ->groupBy('detail_bookings.booking_id')
        // ->get();
        // $booking = Booking::select('bookings.*', 'admins.username as admin_name', 'admins.admin_id')
        // ->leftJoin('detail_bookings', 'bookings.booking_id', '=', 'detail_bookings.booking_id')
        // ->leftJoin('vehicles', 'detail_bookings.vehicle_id', '=', 'vehicles.vehicle_id')
        // ->leftJoin('admins', 'vehicles.admin_id', '=', 'admins.admin_id')
        // ->where('bookings.user_id', $userId)
        // ->groupBy('bookings.booking_id') 
        // ->get();

        $booking = Booking::select('bookings.booking_id', 'bookings.price_total_booking', 'bookings.status', DB::raw('MAX(admins.username) AS admin_name'), DB::raw('MAX(admins.photo_profile) AS admin_photo'), DB::raw('MAX(admins.admin_id) AS admin_id'))
            ->leftJoin('detail_bookings', 'bookings.booking_id', '=', 'detail_bookings.booking_id')
            ->leftJoin('vehicles', 'detail_bookings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->leftJoin('admins', 'vehicles.admin_id', '=', 'admins.admin_id')
            ->where('bookings.user_id', $userId)
            ->groupBy('bookings.booking_id', 'bookings.price_total_booking', 'bookings.status')
            ->get();

        // foreach ($booking as $bookings) {
        //     //echo "Booking ID: " . $booking->booking_id . "\n";
        //     echo "Admin Name: " . $booking->admin_name . "\n";
        //     // tambahkan informasi lain yang ingin Anda tampilkan
        //     echo "\n";
        // }

        //dd($booking);
        return view('user.booking', compact('booking'));
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
