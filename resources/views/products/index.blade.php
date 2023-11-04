@extends('layouts_admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
                <div class="row mb-3">
                    <div class="col-md-6 d-flex align-self-end">
                        <h4>Products</h4>
                    </div>
                    <div class="col-md-6 d-grid justify-content-md-end">
                        <a href="{{ route('product.create') }}" class="btn btn-secondary">Create</a>
                    </div>
                </div>

                <div class="card border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Index</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Category Product</th>
                                        <th scope="col">Store</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row"> {{ $loop->iteration }} </th>
                                            <th scope="row"> <img src="{{ asset('img_products/' . $product->image) }}"
                                                    alt="img_product" height="100">
                                            </th>
                                            <td> {{ $product->name }} </td>
                                            <td> {{ $product->description }} </td>
                                            <td> @currency($product->price) </td>
                                            <td> {{ $product->stock }} </td>
                                            <td> {{ $product->category->name }} </td>
                                            <td> {{ $product->store->name }} </td>
                                            <td style="width:100px">
                                                <a href="{{ route('product.destroy', $product->id) }}" class="btn"
                                                    onclick="return confirm('Do you really want to delete?')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
