@extends('layouts.app')

@section('title', "Laracamp by BuildWith Angga")

@section('content')
    <section class="checkout">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 col-12">
                    <img src="{{ asset('laracamp-template/assets/images/ill_register.png') }}" height="400" class="mb-5" alt=" ">
                </div>
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        WHAT A DAY!
                    </p>
                    <h2 class="primary-header ">
                        Berhasil Checkout
                    </h2>
                    <a href="{{ route('dashboard.user') }}" class="btn btn-primary mt-3">
                        My Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript; choose one of the two! -->
@endsection