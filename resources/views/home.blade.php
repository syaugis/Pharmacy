@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row text-center">
                <h2>PRODUCT LIST</h2>
            </div>

            <div class="d-flex justify-content-end">
                <h6 class="p-2 align-self-end">Filter Product by</h6>
                <form method="get" class="p-2">
                    <select class="form-select" name="filter" onchange="this.form.submit()">
                        <option value=""> All Category </option>
                        @foreach ($product_categories as $product_category)
                            <option value="{{ $product_category->id }}"
                                {{ $product_category->id == request('filter') ? 'selected' : null }}>
                                {{ $product_category->name }} </option>
                        @endforeach
                    </select>
                </form>
            </div>

            @foreach ($products as $product)
                <div class="col-md-4 mt-1 mb-3">
                    <div class="card">
                        <img src="{{ asset('img_products/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->image }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $product->name }}
                            </h5>
                            <p class="card-text">
                                <strong>Price :</strong> @currency($product->price)
                                {{ App\Helpers\CategoryHelpers::getCategoryDescriptions($product->category_id) }}
                                <br>
                                <strong>Stock :</strong> {{ $product->stock }} <br>
                                <hr>
                                <strong>Description :</strong>
                                <span style="display: -webkit-box; -webkit-box-orient: vertical;">
                                    {{ \Illuminate\Support\Str::words($product->description, 20, $end = '...') }}
                                </span>

                            </p>
                            <div class="text-center">
                                <a href=" {{ route('order', $product->id) }} " class="btn btn-primary stretched-link"> <i
                                        class="fa fa-shopping-cart"></i> Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
