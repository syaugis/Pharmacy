@extends('layouts_admin.app')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center d-flex align-items-center overflow-auto" role="alert">
                    <i class="fa-solid fa-circle-exclamation fa-xl me-1"></i>
                    <div>
                        There is an error : {{ $error }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
