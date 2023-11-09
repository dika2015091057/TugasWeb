<?php

namespace App\Http\Controllers\User;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\DetailBooking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //TODO View All Vehicles
    public function viewvehicles()
    {
        $vehicles = vehicle::paginate(6);
        return view('user.home',compact('vehicles'));
        
    }

//TODO DETAIL Vehicle
    public function viewVehicleWithId($id)
    {
        //$id = $request->input('id');
        //dd($id);
        // $data = vehicle::where('vehicle_id', $id)->first();
        
        // $admin = Admin::where('admin_id',$data->admin_id)->first();
        // //dd($admin);
        $vehicle=Vehicle::with('Admin')
        ->where('vehicle_id',$id)
        ->first();
// $vehicle=[
// 'vehicle_id'=>$data->vehicle_id,
// 'name'=>$data->name,
// 'vehicle_photo'=>$data->vehicle_photo,
// 'username'=>$admin->username,
// 'stock'=>$data->stock,
// 'charter_price'=>$data->charter_price
// ];       
//dd($vehicle);
        return view('user.detailVehicle',compact('vehicle'));


    }



    //TODO Update Booking
public function updateBooking(){
}


//TODO SEARCH
public function search(Request $request){

    $search=$request->input('search');
   
    $vehicles = Vehicle::where('name', 'like', '%' . $search . '%')
    ->paginate(6);

// You should replace 'column_name' with the actual column you want to search in.

return view('user.home', compact('vehicles'));
}
public function type(Request $request){

    $type=$request->input('type');
   
    $vehicles = Vehicle::where('type', 'like',$type)
    ->paginate(6);

// You should replace 'column_name' with the actual column you want to search in.

return view('user.home', compact('vehicles'));
}
public function ticket(Request $request){
    //dd($request->detail_id);
    $id=$request->booking_id;

    // $detail= DetailBooking::where('detail_booking_id',$id)->first();
    // $booking= Booking::where('booking_id',121)->first();
    $ticket = DetailBooking::with('Vehicle')
    ->where('booking_id', $id)
    ->get();
   // dd($ticket);
return view('user.ticket', compact('ticket'));

// Menyimpan data $ticket ke dalam session

    
    //return view('user.ticket',compact('detail'));
}
}
