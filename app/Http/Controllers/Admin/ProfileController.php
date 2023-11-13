<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //TODO View Profile Page
    public function view()
    {
        $admin = Auth::user();
        $sum = Vehicle::where('admin_id', $admin->admin_id)->sum('stock');
        return view('admin.profile', compact('admin', 'sum'));
    }

    //TODO Update Profile 
    public function update(request $request)
    {
        $admin = Admin::where('admin_id', Auth::user()->admin_id)->first();

        if ($request->validemail == true && Hash::check($request->password, $admin->password)) {
            if ($request->file('photo') != null) {
                $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan',])->getSecurePath();
                $admin->update(
                    [
                        'photo_profile' => $uploadedFileUrl,
                        'email' => $request->email,
                        'address' => $request->address,
                        'username' => $request->username,
                        'phone_number' => $request->phone_number,
                        'owner' => $request->owner,
                        'updated_at' => now()
                    ]

                );
                // Redirect after successful update
                Auth::logout();
                return redirect('/login');
            }
            $admin->update(
                [
                    'email' => $request->email,
                    'address' => $request->address,
                    'username' => $request->username,
                    'phone_number' => $request->phone_number,
                    'owner' => $request->owner,
                    'updated_at' => now()
                ]

            );
            // Redirect after successful update
            Auth::logout();
            return redirect('/login');
        } elseif ($request->validemail != true && Hash::check($request->password, $admin->password)) {

            if ($request->file('photo') != null) {
                $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan',])->getSecurePath();
                $admin->update(
                    [
                        'photo_profile' => $uploadedFileUrl,
                        'address' => $request->address,
                        'username' => $request->username,
                        'phone_number' => $request->phone_number,
                        'owner' => $request->owner,
                        'updated_at' => now()
                    ]

                );
                // Redirect after successful update
                return redirect()->route('viewProfile')->with('success', 'Profile updated successfully!');
            }
            $admin->update(
                [
                    'address' => $request->address,
                    'username' => $request->username,
                    'phone_number' => $request->phone_number,
                    'owner' => $request->owner,
                    'updated_at' => now()
                ]
            );
            // Redirect after successful update

            return redirect()->route('viewProfile')->with('success', 'Profile updated successfully!');
        }

        // Redirect back if passwords do not match
        return redirect()->route('viewProfile')->with('error', 'Password incorrect. Profile update failed.');
    }
}
