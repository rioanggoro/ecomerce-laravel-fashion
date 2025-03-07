@extends('frontend.layouts.master')

@section('title','E-SHOP || Register Page')

@section('main-content')
<div class="container">

    <!-- Shop Register -->
    <section class="shop register section">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="register-form">
                        <h2 class="text-center">Register</h2>
                        <p class="text-center">Mohon Register agar dapat checkout lebih cepat.</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('register.submit')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required="required" placeholder="masukkan nama anda..." value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required="required" placeholder="masukkan email anda..." value="{{old('email')}}">
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required="required" placeholder="masukkan password anda..." value="{{old('password')}}">
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required="required" placeholder="konfirmasi password anda..." value="{{old('password_confirmation')}}">
                                @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="d-flex gap-2 align-items-center mb-3">
                                <button class="btn btn-primary" type="submit">Register</button>
                                <a href="{{route('login.form')}}" class="btn btn-secondary">Login</a>
                            </div>
                            <div class="text-center my-3">
                                <p>OR</p>
                                <div class="btn-group">
                                    <a href="{{route('login.redirect', 'facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i> Facebook</a>
                                    <a href="{{route('login.redirect', 'github')}}" class="btn btn-dark"><i class="ti-github"></i> GitHub</a>
                                    <a href="{{route('login.redirect', 'google')}}" class="btn btn-danger"><i class="ti-google"></i> Google</a>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Register -->
</div>
@endsection

@push('styles')
<style>
    .btn-facebook {
        background-color: #39579A;
        color: white;
    }
    .btn-facebook:hover {
        background-color: #073088 !important;
    }
    .btn-dark {
        background-color: #444444;
        color: white;
    }
    .btn-dark:hover {
        background-color: black !important;
    }
    .btn-danger {
        background-color: #ea4335;
        color: white;
    }
    .btn-danger:hover {
        background-color: rgb(243, 26, 26) !important;
    }
</style>
@endpush
