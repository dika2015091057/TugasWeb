<?php

namespace App\Http\Controllers\User;


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Update;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use App\Models\UpdateBooking;
use Barryvdh\DomPDF\Facade\Pdf;
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
                            $day = $request->input('day');

                            $detail = new DetailBooking();
                            $detail->booking_id = $booking_id;
                            $detail->vehicle_id = $vehicleId;
                            $detail->qty = $qty;
                            $detail->price_total_charter = $total;
                            $detail->pickup_date = $pickup;
                            $detail->return_date = $return;
                            $detail->day = $day;
                            $detail->save();

                            $count = $totalprice + ($detail->price_total_charter);
                            $update = Booking::where('booking_id', $booking_id)->first();
                            $updateqty = Vehicle::where('vehicle_id', $vehicleId)->first();




                            //dd($newBookingId);
                            // $update->price_total_booking=$count;
                            $update->update(['price_total_booking' => $count]);
                            $countqty = ($updateqty->stock) - $qty;
                            $updateqty->update(['stock' => $countqty]);
                            // ];

                            // $ticket =DetailBooking::where('booking_id',$booking_id)->get();
                            // //return redirect()->route('ticket', $ticket);


                            // Melakukan redirect ke route baru
                            return redirect()->route('ticket', $booking_id);
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
        $day = $request->input('day');

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
        $detail->day = $day;
        $detail->save();

        // update stock vehicle after booking
        $detail->save();

        $updateqty = Vehicle::where('vehicle_id', $vehicleId)->first();
        $countqty = ($updateqty->stock) - $qty;
        $updateqty->update(['stock' => $countqty]);

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

        $booking = Booking::select('bookings.booking_id', 'bookings.price_total_booking', 'bookings.status', DB::raw('MAX(admins.username) AS admin_name'), DB::raw('MAX(admins.photo_profile) AS admin_photo'),DB::raw('MAX(admins.address) AS admin_address'), DB::raw('MAX(admins.admin_id) AS admin_id'))
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


    // //TODO Download DetailBooking
    // public function downloadpdf()
    // {
    //     $userId = Auth::user()->user_id;

    //     $booking = Booking::select('bookings.booking_id', 'bookings.price_total_booking', 'bookings.status', DB::raw('MAX(admins.username) AS admin_name'), DB::raw('MAX(admins.photo_profile) AS admin_photo'), DB::raw('MAX(admins.admin_id) AS admin_id'))
    //         ->leftJoin('detail_bookings', 'bookings.booking_id', '=', 'detail_bookings.booking_id')
    //         ->leftJoin('vehicles', 'detail_bookings.vehicle_id', '=', 'vehicles.vehicle_id')
    //         ->leftJoin('admins', 'vehicles.admin_id', '=', 'admins.admin_id')
    //         ->where('bookings.user_id', $userId)
    //         ->groupBy('bookings.booking_id', 'bookings.price_total_booking', 'bookings.status')
    //         ->get();


    //     $html = view('user.booking', compact('booking'))->render();

    //     // Configure Dompdf
    //     $options = new Options();
    //     $options->set('isHtml5ParserEnabled', true);
    //     $options->set('isRemoteEnabled', true);

    //     $dompdf = new Dompdf($options);
    //     $dompdf->loadHtml($html);

    //     // Render PDF
    //     $dompdf->render();

    //     // Download the generated PDF
    //     return $dompdf->stream('invoice.pdf');
    // }

    public function deletebooking(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // Cek apakah ada detail booking dengan status 'proses'
        $hasOngoingStatus = DetailBooking::where('booking_id', $bookingId)
            ->where('status', 'belum dibayar')
            ->exists();
        
        if (!$hasOngoingStatus) {
            // Hapus detail booking dan booking jika tidak ada yang memiliki status 'proses'
            $detailBookings = DetailBooking::where('booking_id', $bookingId)->get();
            $detailBookings->each->delete();
        
            $booking = Booking::find($bookingId);
            if ($booking) {
                $booking->delete();
            }
        
            return redirect()->route('bookings', Auth::user()->user_id);
        } else {
            return redirect()->back()->with('error', 'Tidak dapat menghapus karena ada detail booking dalam status "proses".');
        }
    }
    public function deleteticket(Request $request)
    {


        $detailBookings = DetailBooking::where('detail_booking_id', $request->input('detail_booking_id'))->first();
        $vehicle = Vehicle::where('vehicle_id', $detailBookings->vehicle_id)->first();
        $count = $vehicle->stock + $detailBookings->qty;
     
        
        //$detailBookings->each->delete();
        $ticket = DetailBooking::find($request->input('detail_booking_id'));

        if ($ticket) {
            $ticket->delete();

            $vehicle->stock = $count; // Misalnya, mengurangi qty sebanyak 1
            $vehicle->save();
        }

        $Bookings = DetailBooking::where('booking_id', $request->input('booking_id'))->get();
        if ($Bookings->isNotEmpty()) {

            return redirect()->route('ticket', $request->booking_id);
        }
        return redirect()->route('bookings', Auth::user()->user_id);
    }
}
