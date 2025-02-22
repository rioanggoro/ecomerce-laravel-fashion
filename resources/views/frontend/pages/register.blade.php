@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Register Page')

@section('main-content')

    <!-- Shop Login -->
    <section class="shop login section" style="position: relative; height: 100vh;">
        <div class="bg-overlay"></div>

        <div class="container"
            style="position: relative; z-index: 1; display: flex; justify-content: center; align-items: center; height: 100%;">
            <div class="row w-100">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form"
                        style="background: #FFFFFF; padding: 30px; border-radius: 10px; 
                            color: #252525;">
                        <h2 style="text-align: start; font-size:24px; font-weight: bold; color:#252525;">Daftar Akun</h2>
                        <p style="text-align: start; font-size:20px; font-weight:400;">
                            Sudah punya akun?
                            <a href="{{ route('login.form') }}" class="btn-login"
                                style="color: #252525; font-size:20px; font-weight: bold;">Login</a>
                        </p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama<span>*</span></label>
                                        <input type="text" name="name" placeholder="" required="required"
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email<span>*</span></label>
                                        <input type="text" name="email" placeholder="" required="required"
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password<span style="color: #858585; font-weight:500;">(min 8
                                                karakter)</span></label>
                                        <input type="password" name="password" placeholder="" required="required"
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Confirm Password<span>*</span></label>
                                        <input type="password" name="password_confirmation" placeholder=""
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;"
                                            required="required" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                < <div class="col-12">
                                    <div class="form-group login-btn" style="margin-top: 20px;">
                                        <button class="btn" type="submit"
                                            style="width: 100%; background: #252525 ; color: white; padding: 10px; 
                                                border: none; border-radius: 5px; font-weight:500; font-size:24px;">
                                            Daftar Akun
                                        </button>
                                    </div>
                            </div>
                    </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection

@push('styles')
    <style>
        .shop.login.section {
            height: 100vh;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/bg1.jpg') }}') no-repeat center center/cover;
            opacity: 0.25;
            z-index: 0;
        }
    </style>
@endpush
