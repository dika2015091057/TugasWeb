<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller {

    //TODO VIEW VEHICLE
    public function view(){
        $admin_id=Auth::user()->admin_id;
        $sum = Vehicle::where('admin_id',$admin_id)->sum('stock');
        $vehicles=Vehicle::where('admin_id',$admin_id)->paginate(5);
        return view('admin.vehicle',compact('vehicles','sum'));
    }
    //TODO View Form CREATE VEHICLE
    public function create() {
        $vehicles=Vehicle::where('admin_id',Auth::user()->admin_id)->orderBy('updated_at', 'DESC')->get();
        return view('admin.createVehicle',compact('vehicles'));
    }
    //TODO DELETE VEHICLE
    public function delete(request $Request) {
        $vehicleId =$Request->vehicle_id;
        $vehicle = Vehicle::find($vehicleId);

        if ($vehicle) {
            $vehicle->delete();
            return redirect(route('viewVehicle'));
        } else {
            return redirect(route('viewVehicle'));
        }
    }
}