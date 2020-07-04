<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class OrdersController extends Controller
{
    public function createNewOrder()
    {
        $order = new \App\Order;
        $order -> order_key = Str::random(8);
        $order -> creator = Auth::user() -> name;
        $order -> status = 0;
        $order -> save();
    }

    public function showOrdersList(Request $request)
    {
        $paginate = 7;
        if ($request -> has('order_key'))
        {
            $orders = \App\Order::where('order_key', $request -> order_key) -> orWhere('order_key', 'like', '%' . $request -> order_key . '%') -> paginate($paginate);
        } else

        $orders = \App\Order::where('id', '>', 0) -> orderByDesc("created_at")  -> paginate($paginate);
       // $orders = \App\Order::orderByDesc('created_at')->get() -> paginate($paginate);
        return view('orders', ['orders' => $orders]);
    }

    public function editDescription($orderId, Request $request)
    {
        $order = \App\Order::find($orderId);
        if (isset($order)){
            $order -> description = $request -> description;
            $order -> save();
        }
    }

    public function destroy($orderId, Request $request)
    {
        $order = \App\Order::find($orderId);
        if (isset($order)){
            $key = $order -> order_key;
            if (Auth::user() -> name != $order -> creator)
            {
                session()->flash('status', 'Вы не можете удалить это.');
                return redirect('/');
            }
            $order -> delete();

            $directory = 'images/'.$orderId;
            $images = Storage::files($directory);
            foreach($images as $image)
                {
                    Storage::delete($image);
                }

            return response()->json([
                'status' => 'Successfully deleted',
                'deleted_key' => $key
            ]);
        }
    }

    public function changePayed($orderId, Request $request)
    {
        $order = \App\Order::find($orderId);
        if (isset($order)){
            $order -> payed = !$order -> payed;
            $order -> save();
            return response()->json([
                'status' => 'Successfully changed'
            ]);
        }
    }

    public function setStatus($orderId, Request $request)
    {
        $order = \App\Order::find($orderId);
        if (isset($order)){
            $newStatus = intval($request -> status);
            if ($newStatus >= 0 && $newStatus <= 2){
                    $order -> status = $newStatus;
                    $order -> save();
                    return response()->json([
                        'status' => 'Successfully set.'
                    ]);
            }
        }
    }

}
