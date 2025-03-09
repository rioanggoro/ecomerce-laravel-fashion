@extends('frontend.layouts.master')

@section('title', 'Checkout page')

@section('main-content')

    <!-- Start Checkout -->
    <section class="checkout-section py-5">
        <div class="container">
            <form class="checkout-form" method="POST" action="{{ route('cart.order') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body p-4">
                                <h2 class="card-title fw-bold mb-2">Checkout Disini</h2>
                                <p class="text-muted mb-4">Mohon Register agar dapat checkout lebih cepat</p>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Nama Depan<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="firstName" name="first_name"
                                                value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Nama Belakang<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="lastName" name="last_name"
                                                value="{{ old('lat_name') }}">
                                            @error('last_name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Alamat Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Nomor HP<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="phone" name="phone"
                                                required value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Negara<span
                                                    class="text-danger">*</span></label>
                                            <select name="country" id="country">
                                                <option value="ID">Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address1" class="form-label">Alamat 1<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address1" name="address1"
                                                value="{{ old('address1') }}">
                                            @error('address1')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address2" class="form-label">Alamat 2</label>
                                            <input type="text" class="form-control" id="address2" name="address2"
                                                value="{{ old('address2') }}">
                                            @error('address2')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="postCode" class="form-label">Kode Pos</label>
                                            <input type="text" class="form-control" id="postCode" name="post_code"
                                                value="{{ old('post_code') }}">
                                            @error('post_code')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <h2 class="card-title fs-4 fw-bold mb-3">Total Keranjang</h2>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-medium">Subtotal Keranjang</span>
                                    <span class="fw-bold order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
                                        Rp {{ number_format(Helper::totalCartPrice(), 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-medium">Biaya Pengiriman</span>
                                        @if (count(Helper::shipping()) > 0 && Helper::cartCount() > 0)
                                            <div class="shipping-select w-50">
                                                <select name="shipping" class="form-select form-select-sm">
                                                    <option value="">Pilih Pengiriman</option>
                                                    @foreach (Helper::shipping() as $shipping)
                                                        <option value="{{ $shipping->id }}" class="shippingOption"
                                                            data-price="{{ $shipping->price }}">
                                                            {{ $shipping->type }}: Rp
                                                            {{ number_format($shipping->price, 0, ',', '.') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <span>Gratis</span>
                                        @endif
                                    </div>
                                </div>

                                @if (session('coupon'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-medium">Kamu hemat</span>
                                        <span class="text-success coupon_price"
                                            data-price="{{ session('coupon')['value'] }}">
                                            Rp {{ number_format(session('coupon')['value'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endif

                                @php
                                    $total_amount = Helper::totalCartPrice();
                                    if (session('coupon')) {
                                        $total_amount = $total_amount - session('coupon')['value'];
                                    }
                                @endphp

                                <div class="d-flex justify-content-between border-top pt-3 mt-3">
                                    <span class="fw-bold fs-5">Total</span>
                                    <span class="fw-bold fs-5" id="order_total_price">
                                        Rp {{ number_format($total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>


                            <div class="card-body border-top p-4">
                                <h2 class="card-title fs-4 fw-bold mb-3">Metode Pembayaran</h2>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                        value="cod">
                                    <label class="form-check-label" for="cod">Cash On Delivery</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal"
                                        value="paypal">
                                    <label class="form-check-label" for="midtrans">Midtrans</label>
                                </div>
                            </div>

                            <div class="card-body border-top p-4">
                                <div class="text-center mb-3">
                                    <img src="{{ 'backend/img/payment-method.png' }}" alt="Payment Methods"
                                        class="img-fluid">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">CHECKOUT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Start Area Layanan Toko -->
    <section class="shop-services section py-5">
        <div class="container">
            <div class="row gap-3 gap-lg-0">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Layanan Tunggal -->
                    <div class="single-service text-center p-4 border rounded shadow-sm">
                        <i class="fas fa-shipping-fast mb-3"></i>
                        <h4>Pengiriman Gratis</h4>
                        <p>Pesanan di atas Rp 50.000</p>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Update total when shipping option changes
            $('select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;

                // Hitung total
                let total = subtotal + cost - coupon;

                // Update total di tampilan
                $('#order_total_price').text('Rp ' + number_format(total, 0, ',', '.'));
            });
        });

        // Fungsi untuk format angka
        function number_format(number, decimals, dec_point, thousands_sep) {
            // Default values
            decimals = decimals || 0;
            dec_point = dec_point || '.';
            thousands_sep = thousands_sep || ',';

            number = parseFloat(number);
            if (isNaN(number)) return '0';

            // Format number
            let parts = number.toFixed(decimals).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
            return parts.join(dec_point);
        }
    </script>
@endpush
