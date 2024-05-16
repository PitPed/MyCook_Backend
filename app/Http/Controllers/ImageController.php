<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImage(Request $request)
    {
        $path = storage_path('app/public/images/') . $request->path;
        if (!file_exists($path)) {
            return response()->json(['message' => 'La imagen no existe', 'path'=>json_encode($path, JSON_UNESCAPED_SLASHES)], 400);
        }
        return response()->download($path);
    }    
}