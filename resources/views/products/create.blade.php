@extends('layouts_admin.app')

@section('content')
    <style>
        .required::after {
            content: ' *';
            color: red;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                    </ol>
                </nav>
                <div class="row mb-3">
                    <div class="col-md-6 d-flex align-self-end">
                        <h4>Add Products</h4>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action=" {{ route('product.store') }} "method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="required" for="name">{{ __('Product Name') }}</label>
                                    <input id="name" type="text" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" name="name" required
                                        autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group mb-3">
                                    <label class="required" for="description"> {{ __('Description') }} </label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" required name="description"
                                        rows="6">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="image"> {{ __('Product Image') }} </label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" required>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="required" for="price">{{ __('Product Price') }} </label>
                                    <input type="number" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror" id="price"
                                        name="price" required>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="required" for="stock">{{ __('Product Stock') }} </label>
                                    <input type="number" value="{{ old('stock') }}"
                                        class="form-control @error('stock') is-invalid @enderror" id="stock"
                                        name="stock" required>

                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="required" for="category_id">{{ __('Product Category') }}</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id" required>
                                        <option value="" disabled selected hidden> Select Product Category </option>
                                        @foreach ($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}"
                                                @if (old('category_id') == $product_category->id) selected @endif>
                                                {{ $product_category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="required" for="store_id">{{ __('Product Store') }}</label>
                                    <select class="form-select  @error('store_id') is-invalid @enderror" name="store_id"
                                        required>
                                        <option value="" disabled selected hidden> Select Product Store </option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}"
                                                @if (old('store_id') == $store->id) selected @endif> {{ $store->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('store_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mt-4 d-flex flex-row">
                                    <div class="p-2 mb-3">
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('product') }}" class="btn btn-danger"></i> Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
