@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Tentang Kami')

@section('main-content')


    <!-- Tentang Kami -->
    <section class="about-us section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        @php
                            $settings = DB::table('settings')->get();
                        @endphp
                        <h3>Selamat datang di <span>Prolific</span></h3>
                        <p>
                            @foreach ($settings as $data)
                                {{ $data->description }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="col-lg-6 col-12">
                        <div class="about-img overlay">
                            <img src="https://images.unsplash.com/photo-1582719188393-bb71ca45dbb9?q=80&w=3387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Tentang Kami" class="img-fluid rounded shadow">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Tentang Kami -->

    <!-- Start Area Layanan Toko -->
    <section class="shop-services section py-5">
        <div class="container">
            <div class="row gap-3 gap-lg-0">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Layanan Tunggal -->
                    <div class="single-service text-center p-4 border rounded shadow-sm">
                        <i class="fas fa-shipping-fast mb-3"></i>
                        <h4>Pengiriman Gratis</h4>
                        <p>Pesanan di atas $100</p>
                    </div>
                    <!-- End Layanan Tunggal -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Layanan Tunggal -->
                    <div class="single-service text-center p-4 border rounded shadow-sm">
                        <i class="fas fa-undo-alt mb-3"></i>
                        <h4>Pengembalian Gratis</h4>
                        <p>Pengembalian dalam 30 hari</p>
                    </div>
                    <!-- End Layanan Tunggal -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Layanan Tunggal -->
                    <div class="single-service text-center p-4 border rounded shadow-sm">
                        <i class="fas fa-lock mb-3"></i>
                        <h4>Pembayaran Aman</h4>
                        <p>Pembayaran 100% aman</p>
                    </div>
                    <!-- End Layanan Tunggal -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Layanan Tunggal -->
                    <div class="single-service text-center p-4 border rounded shadow-sm">
                        <i class="fas fa-tag mb-3"></i>
                        <h4>Harga Terbaik</h4>
                        <p>Harga yang dijamin</p>
                    </div>
                    <!-- End Layanan Tunggal -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Area Layanan Toko -->
@endsection
