@extends('frontend.layouts.master')

@section('title','E-Shop || Login Page')

@section('main-content')
<div class="container">

    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2 class="text-center">Login</h2>
                        <p class="text-center">Mohon Register Terlebih Dahulu, Jika Belum Punya Akun</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('login.submit')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required="required" placeholder="masukkan email anda..." value="{{old('email')}}">
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required="required" placeholder="masukkan password anda..." value="{{old('password')}}">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                    <a href="{{route('register.form')}}" class="btn btn-secondary">Register</a>
                                </div>
                                <div class="text-center my-3">
                                    <p>OR</p>
                                    <div class="btn-group">
                                        <a href="{{route('login.redirect', 'facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i> Facebook</a>
                                        <a href="{{route('login.redirect', 'github')}}" class="btn btn-dark"><i class="ti-github"></i> GitHub</a>
                                        <a href="{{route('login.redirect', 'google')}}" class="btn btn-danger"><i class="ti-google"></i> Google</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="news">
                                <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="lost-pass d-block mt-3" href="{{ route('password.reset') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endpush

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
