<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return view('order');
    }


    public function getOrderInfo($orderKey, Request $request)
    {
        $order = \App\Order::where('order_key', $orderKey) -> first();
        if (isset($order)){
            $directory = 'images/'.$order -> id;
            $images = Storage::files($directory);
            return view('orderinfo', ['images' => $images, 'order' => $order]);
        } else
            abort(404);
    }
}
