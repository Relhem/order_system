<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function upload($orderId, Request $request)
    {
        $order = \App\Order::where('id', $orderId) -> first();
        
        if (!isset($order)) abort(404);
        return view('upload', ['order' => $order]);
    }
}
