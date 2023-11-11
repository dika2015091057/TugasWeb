<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller 
{
    // TODO View Dashboard Admin     
    public function showDashboard() {
        return view('admin.dashboard');
    }
    
}