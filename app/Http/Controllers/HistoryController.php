<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get();
        return view('history.index', compact('orders'));
    }

    public function detail($id): View
    {
        $order = Order::where('id', $id)->first();
        $order_details = OrderDetail::where('order_id', $id)->get();
        return view('history.detail', compact('order', 'order_details'));
    }
}
