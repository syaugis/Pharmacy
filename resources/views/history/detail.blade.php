@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>

                <div class="col-md-12 mt-3">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a style="text-decoration: none" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a style="text-decoration: none" href="{{ route('history') }}">History</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> Details </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-12">
                    @if (!empty($order_details) && !empty($order))
                        <div class="card bg-danger">
                            <div class="card-body">
                                <h5 class="text-center fw-bold text-white" id="countdown"></h5>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                @if ($order->status == 1)
                                    <h4><strong>Your order has been made</strong></h4>
                                    <h5>To continue your order, please transfer to the following bank account
                                        <strong>(BCA bank account number: 1234-4321-0000-1111) </strong>
                                        with total price <strong>@currency($order->total_price + $order->payment_code)</strong>
                                    </h5>
                                @elseif($order->status == 2)
                                    <h4><strong>Your order has been successfully paid</strong></h4>
                                    <h5>Please wait for your shipment</h5>
                                @elseif($order->status == 3)
                                    <h4><strong>Your order has been cancelled</strong></h4>
                                    <h5>Sorry, your order payment has exceeded the payment deadline</h5>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="pt-2">
                                    Order Details History
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
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="5" scope="row" class="text-end">Total Price :</th>
                                                    <td> @currency($order->total_price) </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" scope="row" class="text-end">Payment Code :</th>
                                                    <td> @currency($order->payment_code) </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" scope="row" class="text-end">Total Paid :
                                                    </th>
                                                    <td> @currency($order->total_price + $order->payment_code) </td>
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

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{ \Carbon\Carbon::parse($order->date)->addHours(24) }}");

        // Update the count down every 1 second
        var x = setInterval(function() {
            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the countdown date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="countdown"
            document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text and mark the order as expired
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "YOUR ORDER IS ALREADY EXPIRED";
            }
        }, 1000);
    </script>
@endsection
