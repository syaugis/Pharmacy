@extends('layouts.app')

@section('content')
    <style>
        .qty .count {
            color: #000;
            display: inline-block;
            vertical-align: top;
            font-size: 25px;
            font-weight: 700;
            line-height: 30px;
            padding: 0 2px;
            min-width: 35px;
            text-align: center;
        }

        .qty .plus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial, sans-serif;
            text-align: center;
            border-radius: 50%;
        }

        .qty .minus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial, sans-serif;
            text-align: center;
            border-radius: 50%;
            background-clip: padding-box;
        }

        .minus:hover {
            background-color: #717fe0 !important;
        }

        .plus:hover {
            background-color: #717fe0 !important;
        }

        /*Prevent text selection*/
        .minus,
        .plus {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .count {
            border: 0;
            width: 50%;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>

                <div class="col-md-12 mt-3">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a style="text-decoration: none" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a style="text-decoration: none" href="{{ url('?filter') }}={{ $product->category_id }}">
                                    {{ $product->category->name }} </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ $product->name }}
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-12 mt-2">
                    <div class="card">
                        <div class="card-header" style="height: 3rem">
                            <h3 class="mb-4"> <strong>{{ $product->name }}</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('img_products/' . $product->image) }}" alt="{{ $product->image }}"
                                        class="rounded mx-auto d-block" width="100%">
                                </div>
                                <div class="col-md-6">

                                    <h4><strong>Description</strong><br></h4>
                                    <h5>{{ $product->description }} </h5><br>

                                    <h4><strong>Product Category</strong><br></h4>
                                    <h5>{{ $product->category->name }} </h5><br>

                                    <h4><strong>Price</strong><br></h4>
                                    <h5 class="text-success"><strong>@currency($product->price)</strong> </h5><br>

                                    <h4><strong>Store</strong><br></h4>
                                    <h5><strong>{{ $product->store->name }} </strong>
                                        {{ $product->store->address }}</h5><br>

                                    <h4><strong>Stock</strong><br></h4>
                                    <h5>{{ $product->stock }} </h5>

                                    <form action="{{ route('order', $product->id) }}" method="post"
                                        class="row g-3 align-items-center">
                                        @csrf
                                        <div class="col-auto">
                                            <h4> <label for="order" class="col-form-label"><strong>Order
                                                        Quantity :</strong></label></h4>
                                        </div>
                                        <div class="col-3">
                                            <div class="qty">
                                                <span class="minus bg-dark">-</span>
                                                <input type="number" class="count" name="qty" id="order"
                                                    value="1" min="1" max="{{ $product->stock }}">
                                                <span class="plus bg-dark">+</span>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <button type="submit" class="btn btn-primary mb-3"> <i
                                                    class="fa fa-shopping-cart"></i> Buy</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // $('.count').prop('disabled', true);
            $(document).on('click', '.plus', function() {
                $('.count').val(parseInt($('.count').val()) + 1);
            });
            $(document).on('click', '.minus', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
            });
        });
    </script>
@endsection
