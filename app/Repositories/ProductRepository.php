<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll(): Collection
    {
        return $this->product->get();
    }

    public function getById($id)
    {
        return $this->product->where('id', $id)->first();
    }

    public function store($data): Product
    {
        $product = new $this->product;

        $product->name = $data['name'];
        $product->description = $data['description'];

        $imageName = $data['image']->hashName();
        $data['image']->move(public_path('img_products'), $imageName);
        $product->image = $imageName;

        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->category_id = $data['category_id'];
        $product->store_id = $data['store_id'];
        $product->save();

        return $product;
    }

    public function update($data, $id): Product
    {
        $product = $this->product->find($id);
        $product->name = $data['name'];
        $product->description = $data['description'];
        if (!empty($data['image'])) {
            $imageName = $product->getAttribute('image');
            if (file_exists("img_products/" . $imageName)) {
                unlink('img_products/' . $imageName);
            }
            $imageName = $data['image']->hashName();
            $data['image']->move(public_path('img_products'), $imageName);
            $product->image = $imageName;
        }
        $product->price = $data['price'];
        $product->stock = $data['stock'];
        $product->category_id = $data['category_id'];
        $product->store_id = $data['store_id'];
        $product->update();

        return $product;
    }

    public function destroy($id): Product
    {
        $product = $this->product->find($id);
        if (file_exists("img_products/" . $product->image)) {
            unlink('img_products/' . $product->image);
        }
        $product->delete();

        return $product;
    }
}
