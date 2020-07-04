<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImagesController extends Controller
{
    public function getImages($orderId, Request $request)
    {
 
        $directory = 'images/'.$orderId;
        $images = Storage::files($directory);

       
        return view('images', ['images' => $images]);
    }

    public function download(Request $request)
    {
 
        $path = $request -> path;

        if (!Storage::exists($path)) abort(404);
        return response()->download($path);
    }

    public function destroy(Request $request)
    {
        if (!Storage::exists($request -> path)) abort(404);
        Storage::delete($request -> path);
    }

}
