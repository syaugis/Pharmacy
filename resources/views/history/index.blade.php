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
                            <li class="breadcrumb-item active" aria-current="page"> History </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-12">
                    @if (!empty($orders))
                        <div class="card">
                            <div class="card-header">
                                <h4 class="pt-2">
                                    <i class="fa fa-history me-2 ms-2"></i>
                                    Order History
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Index</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr scope="row">
                                                    <th scope="row"> {{ $loop->iteration }} </th>
                                                    <td> {{ $order->date }} </td>
                                                    <td>
                                                        {{ App\Helpers\OrderHelpers::getStatus($order->status) }}
                                                    </td>
                                                    <td> @currency($order->total_price) </td>
                                                    <td>
                                                        <a href="{{ route('history.detail', $order->id) }}" class="btn">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (empty($orders))
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center">No Results in Order History</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
