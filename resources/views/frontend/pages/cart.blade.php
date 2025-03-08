@extends('frontend.layouts.master')
@section('title', 'Cart Page')
@section('main-content')

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Shopping Summery -->
                    <div class="table-responsive">
                        <table class="table shopping-summery">
                            <thead>
                                <tr class="main-heading">
                                    <th>Produk</th>
                                    <th>Nama</th>
                                    <th class="text-center">Harga Unit</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center"><i class="fa fa-trash remove-icon"></i></th>
                                </tr>
                            </thead>
                            <tbody id="cart_item_list">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    @csrf
                                    @if (Helper::getAllProductFromCart())
                                        @foreach (Helper::getAllProductFromCart() as $key => $cart)
                                            <tr>
                                                @php
                                                    $photo = explode(',', $cart->product['photo']);
                                                @endphp
                                                <td class="image" data-title="No">
                                                    <img src="{{ $photo[0] }}" class="img-fluid rounded"
                                                        style="max-height: 100px" alt="{{ $photo[0] }}">
                                                </td>
                                                <td class="product-des" data-title="Description">
                                                    <p class="product-name">
                                                        <a href="{{ route('product-detail', $cart->product['slug']) }}"
                                                            target="_blank">
                                                            {{ $cart->product['title'] }}
                                                        </a>
                                                    </p>
                                                    <p class="product-des">{!! $cart['summary'] !!}</p>
                                                </td>
                                                <td class="price" data-title="Price">
                                                    <span>Rp{{ number_format($cart['price'], 2) }}</span>
                                                </td>
                                                <td class="qty" data-title="Qty">
                                                    <!-- Input Order -->
                                                    <div class="d-flex gap-2">
                                                        <div class="button minus">
                                                            <button type="button" class="btn btn-primary btn-number"
                                                                disabled="disabled" data-type="minus"
                                                                data-field="quant[{{ $key }}]">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text" name="quant[{{ $key }}]"
                                                            class="rounded px-2" data-min="1" data-max="100"
                                                            value="{{ $cart->quantity }}">
                                                        <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                                                        <div class="button plus">
                                                            <button type="button" class="btn btn-primary btn-number"
                                                                data-type="plus" data-field="quant[{{ $key }}]">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!--/ End Input Order -->
                                                </td>
                                                <td class="text-center" data-title="Size">
                                                    <span class="text-capitalize">{{ $cart['size'] }}</span>
                                                </td>
                                                <td class="total-amount cart_single_price" data-title="Total">
                                                    <span class="money">Rp{{ $cart['amount'] }}</span>
                                                </td>
                                                <td class="action text-center" data-title="Remove">
                                                    <a href="{{ route('cart-delete', $cart->id) }}">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="float-right">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">
                                                Belum ada produk di keranjang
                                                <a href="{{ route('product-grids') }}" class="text-primary">Lanjut
                                                    Belanja</a>
                                            </td>
                                        </tr>
                                    @endif
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <!--/ End Shopping Summery -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-5 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="{{ route('coupon-store') }}" method="POST">
                                            @csrf
                                            <input name="code" class="form-control" placeholder="Masukkan kode kupon"
                                                type="text">
                                            <button class="btn btn-secondary mt-3" type="submit">Apply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 col-12">
                                <div class="right">
                                    <ul class="list-unstyled">
                                        <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
                                            Subtotal <span>Rp{{ number_format(Helper::totalCartPrice(), 2) }}</span>
                                        </li>

                                        @if (session()->has('coupon'))
                                            <li class="coupon_price" data-price="{{ Session::get('coupon')['value'] }}">
                                                Kamu hemat
                                                <span>Rp{{ number_format(Session::get('coupon')['value'], 2) }}</span>
                                            </li>
                                        @endif

                                        @php
                                            $total_amount = Helper::totalCartPrice();
                                            if (session()->has('coupon')) {
                                                $total_amount = $total_amount - Session::get('coupon')['value'];
                                            }
                                        @endphp
                                        <li class="last" id="order_total_price">
                                            Total <span>Rp{{ number_format($total_amount, 2) }}</span>
                                        </li>
                                    </ul>
                                    <div class="button5">
                                        <a href="{{ route('checkout') }}" class="btn btn-dark">Checkout <i
                                                class="fa fa-long-arrow-right"></i></a>
                                        <a href="{{ route('product-grids') }}" class="btn btn-secondary">Lanjut
                                            Belanja</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

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
    @include('frontend.layouts.newsletter')

@endsection

@push('styles')
    <style>
        .form-select .nice-select {
            border: none;
            border-radius: 0;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
        }

        .list li {
            margin-bottom: 0 !important;
        }

        .list li:hover {
            background: #F7941D !important;
            color: white !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {

            .shopping-summery th,
            .shopping-summery td {
                font-size: 12px;
            }

            .shopping-summery td .product-des {
                max-width: 100px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .total-amount .right ul {
                font-size: 14px;
            }

            .input-group {
                flex-direction: column;
            }

            .button {
                width: 100%;
                text-align: center;
            }

            .button5 {
                display: flex;
                flex-direction: column;
            }

            .button5 a {
                margin-bottom: 10px;
            }
        }

        /* For Mobile */
        @media (max-width: 576px) {
            .shopping-summery td .product-des {
                display: none;
            }

            .shopping-summery td .price,
            .shopping-summery td .qty {
                text-align: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $("select.select2").select2();
            $('select.nice-select').niceSelect();
        });

        $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });
        });
    </script>
@endpush
