<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller{
    public function view(){
        $profile=User::where('user_id', Auth::user()->user_id)->first();
        
        return view('user.profile',compact('profile'));
    }
}