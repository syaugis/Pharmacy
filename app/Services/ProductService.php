<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getById($id): Product
    {
        return $this->productRepository->getById($id);
    }

    public function store($data): Product
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' =>  'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric|exists:product_categories,id',
            'store_id' => 'required|numeric|exists:stores,id',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }
        $product = $this->productRepository->store($data);

        return $product;
    }

    public function update($data, $id): Product
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' =>  'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric|exists:product_categories,id',
            'store_id' => 'required|numeric|exists:stores,id',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator->errors()];
        }

        DB::beginTransaction();
        try {
            $product = $this->productRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }
        DB::commit();

        return $product;
    }

    public function destroy($id): Product
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->destroy($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete product data');
        }
        DB::commit();

        return $product;
    }
}
