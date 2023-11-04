@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>

                <div class="col-md-12 mt-3">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a style="text-decoration: none" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Checkout </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-12">
                    @if (!empty($order_details) && !empty($order))
                        <div class="card">
                            <div class="card-header">
                                <h4 class="pt-2">
                                    Checkout Details
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <p class="text-end"> <strong>Order At :</strong>
                                            {{ \Carbon\Carbon::parse($order->date)->diffForHumans() }}</p>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Index </th>
                                                    <th scope="col">Image </th>
                                                    <th scope="col">Name </th>
                                                    <th scope="col">Qty </th>
                                                    <th scope="col">Price </th>
                                                    <th scope="col">Total Price </th>
                                                    <th scope="col">Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_details as $order_detail)
                                                    <tr scope="row">
                                                        <th scope="row"> {{ $loop->iteration }} </th>
                                                        <td>
                                                            <img src="{{ asset('img_products/' . $order_detail->product->image) }}"
                                                                width="100" alt="{{ $order_detail->product->image }}">
                                                        </td>
                                                        <td> {{ $order_detail->product->name }} </td>
                                                        <td> {{ $order_detail->qty }}
                                                            @if ($order_detail->product->category_id == 1)
                                                                Tablet
                                                            @elseif ($order_detail->product->category_id == 2)
                                                                Pcs
                                                            @endif
                                                        </td>
                                                        <td> @currency($order_detail->product->price) </td>
                                                        <td> @currency($order_detail->qty * $order_detail->product->price) </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('checkout.destroy', $order_detail->id) }}"
                                                                method="post">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Confirm delete?')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="5" scope="row" class="text-end">Total Prices : </th>
                                                    <td> @currency($order->total_price) </td>
                                                    <td>
                                                        <a href="{{ route('checkout.confirm') }}"
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Confirm Order?')">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    @endif
                    @if (empty($order) || empty($order_details))
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">No Results in Orders</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
