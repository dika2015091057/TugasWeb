<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailBooking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //TODO View Bookings
    public function view()
    {
        $admin_id = Auth::user()->admin_id;

        $sum = Vehicle::where('admin_id', $admin_id)->sum('stock');

        $bookings = Booking::whereHas('detail.vehicle', function ($query) use ($admin_id) {
            $query->where('admin_id', $admin_id);
        })->with('detail', 'user')->paginate(5);


        return view('admin.booking', compact('bookings', 'sum'));
    }

    //TODO Delete Booking
    public function delete(request $request)
    {
        $booking_id =$request->booking_id;
        $detail = DetailBooking::where('booking_id', $booking_id)->first();
        if ($detail) {
            return redirect(route('viewBooking'));
        }else{
            $booking=Booking::find($booking_id);
            $booking->delete();
            return redirect(route('viewBooking'));
        }
        
    }

    //TODO View Detail Booking
    public function detailView(request $request)
    {
        $id = $request->booking_id;
        $booking = DetailBooking::where('booking_id', $id)
        ->where('status', '!=', 'lunas') // Filter status bukan "lunas"
        ->first();
        if ($booking){
            $update=Booking::where('booking_id',$id)->first();
            $update->status='Proses';
            $update->save();
            $details = DetailBooking::where('booking_id', $id)->with('booking.user', 'vehicle')->paginate(5);
            return view('admin.detailBooking', compact('details', 'id'));
        }else{
            $update=Booking::where('booking_id',$id)->first();
            $update->status='Selesai';
            $update->save();
            $details = DetailBooking::where('booking_id', $id)->with('booking.user', 'vehicle')->paginate(5);
            return view('admin.detailBooking', compact('details', 'id'));
        }
    }

    //TODO Update Status Detail Booking
    public function updateStatus(Request $request)
    {
        $detail = DetailBooking::where('detail_booking_id', $request->detail_booking_id)->first();

        if ($detail) {
            $detail->update([
                'status' => $request->status
            ]);
        }

        return redirect()->route('viewDetailBooking', $request->booking_id);
    }

    //TODO Delete Detail_booking
    public function deleteDetailBooking(Request $request)
    {
        $detail = DetailBooking::find($request->detail_booking_id);
        if ($detail) {
            $detail->delete();
            return redirect()->route('viewDetailBooking', $request->booking_id);
        }
        return redirect()->route('viewDetailBooking', $request->booking_id);
    }
}
