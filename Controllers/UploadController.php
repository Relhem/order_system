<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    function upload($orderId, Request $request)
    {
      $order = \App\Order::find($orderId);
      if (isset($order)){
          $image_code = '';
          for ($i = 0; $i < count($request -> files); $i++) {
            $image = $request->file('photo-'.$i);

            request()->validate([
              'photo-'.$i  => 'required|mimes:jpeg,jpg,png|max:2048',
            ]);

            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            
            //$image->move(public_path('images/'.$orderId), $new_name);

            Storage::put('images/'.$orderId, $image);

            $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/images/'.$new_name.'" class="img-thumbnail" /></div>';
          }
          $output = array(
            'success'  => 'Images uploaded successfully',
            'image'   => $image_code
          );

          return response()->json($output);
      }
    }
}
