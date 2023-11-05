<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class CloudinaryMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->hasFile('file')) {
            $uploadedFileUrl = cloudinary()->uploadFile($request->file('file')->getRealPath())->getSecurePath();
            // You can do something with the uploaded file URL here, like storing it in the database.
        }

        return $next($request);
    }
}
