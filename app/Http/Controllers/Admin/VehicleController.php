<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller {
    public function view(){
        $admin_id=Auth::user()->admin_id;
        $sum = Vehicle::where('admin_id',$admin_id)->sum('stock');
        $vehicles=Vehicle::where('admin_id',$admin_id)->paginate(5);
        return view('admin.vehicle',compact('vehicles','sum'));
    }
}