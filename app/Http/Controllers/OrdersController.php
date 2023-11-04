<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as Mail;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use InvalidArgumentException;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id): View
    {
        $product = Product::find($id);
        return view('order.index', compact('product'));
    }

    public function order(Request $request, $id): RedirectResponse
    {
        $product = Product::find($id);

        if ($request->qty > $product->stock) {
            alert()->error('Your order quantity is too high');
            return redirect()->route('order', $id);
        }

        $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (empty($new_order)) {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->status = 0;
            $order->total_price = 0;
            $order->date = now();
            $order->payment_code = rand(1, 99);
            $order->save();
        }

        DB::beginTransaction();
        try {
            $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
            $new_order_detail = OrderDetail::where('product_id', $product->id)->where('order_id', $new_order->id)->first();

            if (empty($new_order_detail)) {
                $order_detail = new OrderDetail;
                $order_detail->product_id = $product->id;
                $order_detail->order_id = $new_order->id;
                $order_detail->qty = $request->qty;
                $order_detail->save();
            } else {
                $order_detail = $new_order_detail;
                $order_detail->qty += $request->qty;
                $order_detail->update();
            }

            $order = $new_order;
            $new_price = $product->price * $request->qty;
            $order->total_price += $new_price;
            $order->update();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to add order');
        }
        DB::commit();

        alert()->toast('Your order has been added to your cart', 'success');
        return redirect()->route('checkout');
    }

    public function checkout(): View
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_details = [];
        if (!empty($order)) {
            $order_details = OrderDetail::where('order_id', $order->id)->get();
        }

        return view('order.checkout', compact('order', 'order_details'));
    }

    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $order_detail = OrderDetail::where('id', $id)->first();
            $order = Order::where('id', $order_detail->order_id)->first();
            $order->total_price -= ($order_detail->qty * $order_detail->product->price);
            $order->update();
            $order_detail->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete order');
        }
        DB::commit();

        alert()->toast('Your order has been deleted from your cart', 'success');
        return redirect()->route('checkout');
    }

    public function confirm(): RedirectResponse
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user->address) || empty($user->contact)) {
            alert()->error('Please complete your personal identity');
            return redirect()->route('profile');
        }

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        $check_order = OrderDetail::where('order_id', $order->id)->first();
        if ($check_order == null) {
            alert()->error('Your order doesnt have order items');
            return redirect()->route('home');
        }

        DB::beginTransaction();
        try {
            $order->status = 1;
            $order->date = now();
            $order->update();
            foreach ($order_details as $order_detail) {
                $product = Product::where('id', $order_detail->product_id)->first();
                $product->stock -= $order_detail->qty;
                $product->update();
            }

            $order = Order::find($order->id);
            $this->sendPDF($user, $order, $order_details);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to chekout order');
        }
        DB::commit();

        alert()->toast('Your order has been successfully processed', 'success');
        return redirect()->route('history.detail', $order);
    }

    public function sendPDF($user, $order, $order_details): void
    {
        $data = [
            "user" => $user,
            "order" => $order,
            "order_details" => $order_details,
            "email" => $user->email,
            "title" => "Your Order Invoice On Pharmacy In " . Carbon::parse($order->date)->format('d/m/Y') . " At " . Carbon::parse($order->date)->format('H:i:s'),
        ];

        $pdf = PDF::loadView('pdf_mail', $data);
        Mail::send('pdf_mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "Pharmacy Invoice (" . $data["order"]->date . ").pdf");
        });
    }
}
