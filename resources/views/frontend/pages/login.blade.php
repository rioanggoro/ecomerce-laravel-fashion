@extends('frontend.layouts.master')

@section('title', 'Prolific || Login Page')

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

                        <h2 style="text-align: start; font-size:24px; font-weight: bold; color:#252525;">Login</h2>
                        <p style="text-align: start; font-size:20px; font-weight:400;">
                            Pengguna baru?
                            <a href="{{ route('register.form') }}" class="btn-register"
                                style="color: #252525; font-size:20px; font-weight: bold;">Daftar Akun</a>
                        </p>

                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Masukkan Email Anda"
                                            required="required" value="{{ old('email') }}"
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Masukkan Password Anda"
                                            required="required" value="{{ old('password') }}"
                                            style="width: 100%; padding: 10px; border: 1px solid #000000; border-radius: 5px; color: black;">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between align-items-center">
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="2">
                                            <input name="remember" id="2" type="checkbox"> Ingat Saya
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="lost-pass" href="{{ route('password.reset') }}"
                                            style="color: #858585; font-weight: 400; font-size: 16px; text-decoration: underline;">
                                            Lupa Password?
                                        </a>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn" style="margin-top: 20px;">
                                        <button class="btn" type="submit"
                                            style="width: 100%; background: #252525; color: white; padding: 10px; 
                                                border: none; border-radius: 5px; font-weight:500; font-size:24px;">
                                            Login
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
@endsection
