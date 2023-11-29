<?php

namespace App\Http\Controllers\User;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //TODO View All Vehicles
    public function viewvehicles()
    {
        $vehicles = vehicle::paginate(6);
        if($vehicles->isEmpty()){
            Alert::info('Info', 'Kendaraan Tidak Ditemukan');
            return view('user.home', compact('vehicles'));
        }
        return view('user.home', compact('vehicles'));
    }

    //TODO DETAIL Vehicle
    public function viewVehicleWithId($id)
    {
        $vehicle = Vehicle::with('Admin')
            ->where('vehicle_id', $id)
            ->first();
        $adminVehicles = Vehicle::where('admin_id', $vehicle->admin->admin_id)->get();

        return view('user.detailVehicle', compact('vehicle', 'adminVehicles'));
    }

    //TODO SEARCH
    public function search(Request $request)
    {
        $search = $request->input('search');
        $vehicles = Vehicle::where('name', 'like', '%' . $search . '%')->orderby('name')
            ->paginate(6);
        if ($vehicles->isEmpty()) {
            Alert::info('Info', 'Kendaraan Tidak Ditemukan');
            return view('user.home', compact('vehicles'));
            
        }
        return view('user.home', compact('vehicles'));
    }

    //TODO FILTER WithType
    public function type(Request $request)
    {
        $type = $request->input('type');
        $vehicles = Vehicle::where('type', 'like', $type)
            ->paginate(6);
            if($vehicles->isEmpty()){
                Alert::info('Info', 'Kendaraan Tidak Ditemukan');
                return view('user.home', compact('vehicles'));
            }
        return view('user.home', compact('vehicles'));
    }

    //TODO View TICKET
    public function ticket(Request $request)
    {
        $id = $request->booking_id;
        $booking = [
            'booking_id' => $id,
        ];

        $ticket = DetailBooking::with('Vehicle')
            ->where('booking_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        $vehicle = DetailBooking::with('Vehicle')
            ->where('booking_id', $id)
            ->first();

        if ($vehicle != null) {
            $admin = Admin::where('admin_id', $vehicle->vehicle->admin_id)->first();
            return view('user.ticket', compact('ticket', 'admin', 'booking'));
        }
        Alert::info('Info', 'Data Booking ini kosong');
        return redirect()->route('bookings', Auth::user()->user_id);
    }

    //TODO DOWNLOAD TICKET
    public function downloadTicket(Request $request)
    {

        $id = $request->detail_booking_id;
        $tickets = DetailBooking::with('Vehicle')
            ->where('detail_booking_id', $id)
            ->first();

        $admin = Admin::where('admin_id', $tickets->vehicle->admin_id)->first();
        $pdf = Pdf::loadView('user.printTicket', ['tickets' => $tickets, 'admin' => $admin]);
        return $pdf->download('ticket' . $id . '.pdf');
    }
}
