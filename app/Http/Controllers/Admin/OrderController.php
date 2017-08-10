<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ShareBuy\Models\User;

class OrderController extends Controller
{
    public function index(Request$request)
    {

        $status = $request->input('status');
        $orderItem = $request->input('order-item');
        $order = Order::when(strlen($status),function($query) use ($status){
            return $query->where('status',$status);
        })->when($orderItem,function($query) use ($orderItem){
            return $query->where('order_number',$orderItem);
        })->orderBy('status')->paginate();
        return view('admin.order',['order'=>$order]);
    }
}
