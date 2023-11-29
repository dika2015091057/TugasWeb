<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class BookingController extends Controller
{
    //TODO View Bookings
    public function view(request $request)
    {
        $search = $request->input('search');
        $admin_id = Auth::user()->admin_id;

        $sum = Vehicle::where('admin_id', $admin_id)->sum('stock');

        $booking = Booking::whereHas('detail.vehicle', function ($query) use ($admin_id) {
            $query->where('admin_id', $admin_id);
        })->with('detail', 'user');

        if (!empty($search)) {
            $booking->where(function ($query) use ($search) {
                $query->where('price_total_booking', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $bookings = $booking->sortable()->paginate(5);

        if ($bookings->isEmpty()) {
            Alert::info('Info', 'Booking Kosong');
            return view('admin.booking', compact('bookings', 'sum', 'search'));
        }
        return view('admin.booking', compact('bookings', 'sum', 'search'));
    }

    //TODO Delete Booking
    public function delete(request $request)
    {
        $booking_id = $request->booking_id;
        $detail = DetailBooking::where('booking_id', $booking_id)->first();
        if ($detail) {
            Alert::warning('Booking gagal dihapus', 'silakan hapus detail booking terlebih dahulu');

            return redirect(route('viewBooking'));
        } else {
            $booking = Booking::find($booking_id);
            $booking->delete();

            Alert::success('Booking', 'Booking berhasil dihapus');
            return redirect(route('viewBooking'));
        }
    }

    //TODO View Detail Booking
    public function detailView(request $request)
    {
        $id = $request->booking_id;
        $check = DetailBooking::where('booking_id', $id)->get();
        $booking = DetailBooking::where('booking_id', $id)
            ->where('status', '!=', 'lunas') // Filter status bukan "lunas"
            ->first();
        if ($check->isEmpty()) {
            $details = DetailBooking::where('booking_id', $id)->with('booking.user', 'vehicle')->sortable()->paginate(5);
            Alert::info('Info Detail Booking', 'Detail Booking Kosong');
            return view('admin.detailBooking', compact('details', 'id'));
        }
        if ($booking) {
            $update = Booking::where('booking_id', $id)->first();
            $update->status = 'Proses';
            $update->save();
            $details = DetailBooking::where('booking_id', $id)->with('booking.user', 'vehicle')->sortable()->paginate(5);
            return view('admin.detailBooking', compact('details', 'id'));
        } else {
            $update = Booking::where('booking_id', $id)->first();
            $update->status = 'Selesai';
            $update->save();
            $details = DetailBooking::where('booking_id', $id)->with('booking.user', 'vehicle')->sortable()->paginate(5);
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
            toast('status berhasil diubah', 'success');
        }

        return redirect()->route('viewDetailBooking', $request->booking_id);
    }

    //TODO Delete Detail_booking
    public function deleteDetailBooking(Request $request)
    {
        $detail = DetailBooking::find($request->detail_booking_id);
        if ($detail) {
            
            $vehicle = Vehicle::where('vehicle_id', $detail->vehicle_id)->first();
            if ($vehicle) {
                $stok = $vehicle->stock + $detail->qty;
                $vehicle->update(['stock' => $stok]);
            } else {
                // Handle the case when the vehicle is not found
                // You might want to log an error, display a message, or take other actions
            }

            $booking = Booking::find($detail->booking_id);
            $total = $booking->price_total_booking - $detail->price_total_charter;
            $total = max(0, $total);
            $booking->update(['price_total_booking' => $total]);
            $detail->delete();
            Alert::success('Detail Booking', 'Data berhasil dihapus');

            return redirect()->route('viewDetailBooking', $request->booking_id);
        }
        return redirect()->route('viewDetailBooking', $request->booking_id);
    }
}
