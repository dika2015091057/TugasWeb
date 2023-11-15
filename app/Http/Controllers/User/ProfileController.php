<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // TODO View Profile
    public function view()
    {
        $profile = User::where('user_id', Auth::user()->user_id)->first();

        return view('user.profile', compact('profile'));
    }

    // TODO Update Profile
    public function updateProfile(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        if ($request->validemail == true && Hash::check($request->password, $user->password)) {
            if ($request->file('photo') != null) {
                $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan','transformation' => [
                    'width' => 300, 
                    'height' => 200, 
                    'crop' => 'fill' 
                ]])->getSecurePath();
                $user->update(
                    [
                        'photo_profile' => $uploadedFileUrl,
                        'name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'username' => $request->username,
                        'phone_number' => $request->phone_number,
                        'nik' => $request->nik,
                        'updated_at' => now()
                    ]

                );
                // Redirect after successful update
                Auth::logout();
                return redirect('/login');
            }
            $user->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'username' => $request->username,
                    'phone_number' => $request->phone_number,
                    'nik' => $request->nik,
                    'updated_at' => now()
                ]

            );
            // Redirect after successful update
            Auth::logout();
            return redirect('/login');
        } elseif ($request->validemail != true && Hash::check($request->password, $user->password)) {
            if ($request->file('photo') != null) {
                $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan','transformation' => [
                    'width' => 300, 
                    'height' => 200, 
                    'crop' => 'fill' 
                ]])->getSecurePath();
                $user->update(
                    [
                        'photo_profile' => $uploadedFileUrl,
                        'name' => $request->name,
                        'address' => $request->address,
                        'username' => $request->username,
                        'phone_number' => $request->phone_number,
                        'nik' => $request->nik,
                        'updated_at' => now()
                    ]

                );
                // Redirect after successful update

                return redirect()->route('view')->with('success', 'Profile updated successfully!');
            }
            $user->update(
                [
                    'name' => $request->name,
                    'address' => $request->address,
                    'username' => $request->username,
                    'phone_number' => $request->phone_number,
                    'nik' => $request->nik,
                    'updated_at' => now()
                ]

            );
            // Redirect after successful update

            return redirect()->route('view')->with('success', 'Profile updated successfully!');
        }

        // Redirect back if passwords do not match
        return redirect()->route('view')->with('error', 'Password incorrect. Profile update failed.');
    }
}
