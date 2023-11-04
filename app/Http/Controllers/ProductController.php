<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use App\Models\User;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan validasi dengan kebutuhan Anda.
        ]);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $securePath = MediaAlly::fromFile($uploadedFile)->getSecurePath();

            $user = new user ([
                'image_url' => $securePath,
            ]);

            $user->update();

            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }

        return redirect()->back()->with('error', 'No image file provided.');
    }
}
