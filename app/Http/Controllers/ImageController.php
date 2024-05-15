<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

class ImageController extends Controller
{
    public function getFoto(Request $request)
    {
        $path = storage_path('app\\public\\images\\') . $request->path;

        if (!file_exists($path)) {
            return response()->json(['message' => 'La imagen no existe'], 400);
        }
        return response()->file($path);
    }

    private function saveImage(Request $request, string $fileName)
    {
        $paths = [];
        foreach ($request->file($fileName) as $file) {
            $paths[] = Str::after($file->storePublicly('images', 'public'), 'images/');
        }
        return $paths;
    }
}