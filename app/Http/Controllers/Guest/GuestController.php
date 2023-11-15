<?php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;

class GuestController extends Controller{

    //TODO View Landing Page
    public function index(){
        return view('guest.landingPage');
    }
}