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
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                <i class="fa fa-user small"></i> &nbsp; My Profile
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action=" {{ route('profile.update') }} "method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" value="{{ $user->email }}" required autocomplete="email"
                                        name="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="birth_date">{{ __('Birth Date') }}</label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                        id="birth_date" name="birth_date" value="{{ $user->birth_date }}" required
                                        autocomplete="bday">

                                    @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    <select class="form-select  @error('gender') is-invalid @enderror" name="gender"
                                        required autocomplete="sex">
                                        <option selected>{{ $user->gender }} </option>
                                        @if (!($user->gender == 'Male'))
                                            <option value="Male">Male</option>
                                        @endif
                                        @if (!($user->gender == 'Female'))
                                            <option value="Female">Female</option>
                                        @endif
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $user->address }}" required
                                        autocomplete="address-line1">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="city">{{ __('City') }}</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        id="city" name="city" value="{{ $user->city }}" required
                                        autocomplete="address-level2">

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="contact">{{ __('Contact') }}</label>
                                    <input type="number" class="form-control @error('contact') is-invalid @enderror"
                                        id="contact" name="contact" value="{{ $user->contact }}" required
                                        autocomplete="tel">

                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="paypal_id">{{ __('Paypal ID') }}</label>
                                    <input type="text" class="form-control @error('paypal_id') is-invalid @enderror"
                                        id="paypal_id" name="paypal_id" value="{{ $user->paypal_id }}" required
                                        autocomplete="paypal_id">

                                    @error('paypal_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="image">{{ __('Image Profile') }}</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group mb-3">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div> --}}

                                <button type="submit" class="btn btn-primary mt-2">Edit Profile</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
