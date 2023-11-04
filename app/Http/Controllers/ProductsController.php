<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductsController extends Controller
{
    protected $productService;
    protected $productCategoryService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService)
    {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
    }

    public function index(): View
    {
        try {
            $products = $this->productService->getAll();
            return view('products.index', compact('products'));
        } catch (Exception $e) {
            $error = $e->getMessage();
            return view('error', compact('error'));
        }
    }

    public function create(): View
    {
        $product_categories = $this->productCategoryService->getAll();
        $stores = Store::all();
        return view('products.create', compact('product_categories', 'stores'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->only([
            'name',
            'description',
            'image',
            'price',
            'stock',
            'category_id',
            'store_id',
        ]);

        $response = $this->productService->store($data);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        alert()->toast('Your product has been added', 'success');
        return redirect()->route('product');
    }

    public function edit($id): View
    {
        $product = $this->productService->getById($id);
        $product_categories = $this->productCategoryService->getAll();
        $stores = Store::all();
        return view('products.edit', compact('product', 'product_categories', 'stores'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $data = $request->only([
            'name',
            'description',
            'image',
            'price',
            'stock',
            'category_id',
            'store_id',
        ]);

        $response = $this->productService->update($data, $id);

        if (isset($response['error'])) {
            return back()->withErrors($response['error'])->withInput();
        }

        alert()->toast('Your product has been added', 'success');
        return redirect()->route('product');
    }

    public function destroy($id): RedirectResponse
    {
        $this->productService->destroy($id);
        return redirect()->route('product');
    }
}
