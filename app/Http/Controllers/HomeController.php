<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $product_categories = ProductCategory::get();
        $products = Product::paginate(25);

        if (request('filter')) {
            $products = Product::where('category_id', request('filter'))->paginate(25);
        }

        return view('home', compact('products', 'product_categories'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome(): View
    {
        $product = Product::count();
        $order = Order::count();
        $product_category = ProductCategory::count();
        return view('admin_home', compact('product', 'order', 'product_category'));
    }
}
