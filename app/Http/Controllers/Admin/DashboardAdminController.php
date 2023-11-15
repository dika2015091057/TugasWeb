<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller 
{
    // TODO View Dashboard Admin     
    public function showDashboard() {
        $admin_id = Auth::user()->admin_id;
        $bookings = Booking::whereHas('detail.vehicle', function($query) use ($admin_id) {
            $query->where('admin_id', $admin_id);
        })->with('detail','user')
        ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu dibuat, terbaru ke terlama
      ->take(5) // Ambil 5 booking terbaru
      ->get();

      $vehicles=Vehicle::where('admin_id',$admin_id)->take(5)->get();
     

        $sum = Vehicle::where('admin_id',$admin_id)->sum('stock');
        return view('admin.dashboard',compact('bookings','sum','vehicles'));
    }
    
}