@extends('frontend.layouts.master')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="description" content="{{ $product_detail->summary }}">
    <meta property="og:url" content="{{ route('product-detail', $product_detail->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $product_detail->title }}">
    <meta property="og:image" content="{{ $product_detail->photo }}">
    <meta property="og:description" content="{{ $product_detail->description }}">
@endsection

@section('title', 'E-SHOP || PRODUCT DETAIL')

@section('main-content')

    <div class="container mb-5">
        <div class="row align-items-start">
            <!-- Product Description Column -->
            <div class="col-md-3">
                <h2>{{ $product_detail->title }}</h2>
                <div class="d-flex align-items-center mb-3">
                    <div class="rating me-2">
                        @php
                            $rate = ceil($product_detail->getReview->avg('rate'));
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($rate >= $i)
                                <i class="fa fa-star text-warning"></i>
                            @else
                                <i class="fa fa-star-o text-warning"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p>{!! $product_detail->summary !!}</p>
            </div>

            <!-- Product Image Column -->
            <div class="col-md-5">
                <div class="row">
                    @php
                        $photo = explode(',', $product_detail->photo);
                    @endphp
                    <div class="carousel-thumbnails d-none d-md-flex flex-column gap-2 col-md-2 hidden-md">
                        @foreach ($photo as $key => $img)
                            <img src="{{ $img }}" alt="Thumbnail {{ $key + 1 }}" class="img-thumbnail mb-2"
                                data-bs-target="#productCarousel" data-bs-slide-to="{{ $key }}"
                                @if ($key == 0) class="active" @endif>
                        @endforeach
                    </div>
                    <div id="productCarousel" class="carousel slide col-md-10" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($photo as $key => $img)
                                <div class="carousel-item @if ($key == 0) active @endif">
                                    <img src="{{ $img }}" class="d-block w-100" alt="Product {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Details Column -->
            <div class="col-md-4">
                @php
                    $after_discount =
                        $product_detail->price - ($product_detail->price * $product_detail->discount) / 100;
                @endphp
                <h3 class="mb-2">Rp{{ number_format($after_discount, 2) }}</h3>
                @if ($product_detail->discount > 0)
                    <p><s class="text-muted">Rp{{ number_format($product_detail->price, 2) }}</s>
                        <span class="badge bg-danger">{{ $product_detail->discount }}% OFF</span>
                    </p>
                @endif

                @if ($product_detail->size)
                    <h5 class="mt-4">UKURAN</h5>
                    <div class="d-flex flex-wrap gap-2 my-4">
                        @php
                            $sizes = explode(',', $product_detail->size);
                        @endphp
                        @foreach ($sizes as $size)
                            <div class="col-3 text-center border rounded p-2">{{ $size }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('single-add-to-cart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="slug" value="{{ $product_detail->slug }}">

                    <div class="mb-4">
                        <h5>Quantity:</h5>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="decrement">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="text" name="quant[1]" class="form-control text-center" value="1"
                                id="quantity" min="1" max="{{ $product_detail->stock }}">
                            <button type="button" class="btn btn-outline-secondary" id="increment">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h6>
                            Kategori:
                            <span class="fw-normal">
                                <a href="{{ route('product-cat', $product_detail->cat_info['slug']) }}"
                                    class="text-decoration-none">
                                    {{ $product_detail->cat_info['title'] }}
                                </a>
                            </span>
                        </h6>
                        @if ($product_detail->sub_cat_info)
                            <h6>
                                Sub Kategori:
                                <span class="fw-normal">
                                    <a href="{{ route('product-sub-cat', [$product_detail->cat_info['slug'], $product_detail->sub_cat_info['slug']]) }}"
                                        class="text-decoration-none">
                                        {{ $product_detail->sub_cat_info['title'] }}
                                    </a>
                                </span>
                            </h6>
                        @endif
                        <h6>
                            Stock:
                            @if ($product_detail->stock > 0)
                                <span class="badge bg-success">{{ $product_detail->stock }}</span>
                            @else
                                <span class="badge bg-danger">Stok Habis</span>
                            @endif
                        </h6>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark">
                            <i class="fa fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                        <a href="{{ route('add-to-wishlist', $product_detail->slug) }}" class="btn btn-outline-danger">
                            <i class="fa fa-heart"></i> Tambah ke Favorit
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Description Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description" type="button" role="tab" aria-controls="description"
                            aria-selected="true">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                            type="button" role="tab" aria-controls="reviews" aria-selected="false">Ulasan</button>
                    </li>
                </ul>
                <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        {!! $product_detail->description !!}
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <!-- Reviews Summary -->
                        <div class="mb-4">
                            <h4>Ringkasan Rating</h4>
                            <div class="d-flex align-items-center">
                                <h2 class="me-3 mb-0">{{ ceil($product_detail->getReview->avg('rate')) }}/5</h2>
                                <div>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if (ceil($product_detail->getReview->avg('rate')) >= $i)
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star-o text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="mb-0">Berdasarkan {{ $product_detail->getReview->count() }} ulasan</p>
                                </div>
                            </div>
                        </div>

                        <!-- Review Form -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Tulis Ulasan</h5>
                            </div>
                            <div class="card-body">
                                @auth
                                    <form action="{{ route('review.store', $product_detail->slug) }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="rating-box">
                                                <div class="star-rating">
                                                    <div class="star-rating__wrap">
                                                        <input class="star-rating__input" id="star-rating-5" type="radio"
                                                            name="rate" value="5">
                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-5"
                                                            title="5 out of 5 stars"></label>
                                                        <input class="star-rating__input" id="star-rating-4" type="radio"
                                                            name="rate" value="4">
                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-4"
                                                            title="4 out of 5 stars"></label>
                                                        <input class="star-rating__input" id="star-rating-3" type="radio"
                                                            name="rate" value="3">
                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-3"
                                                            title="3 out of 5 stars"></label>
                                                        <input class="star-rating__input" id="star-rating-2" type="radio"
                                                            name="rate" value="2">
                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-2"
                                                            title="2 out of 5 stars"></label>
                                                        <input class="star-rating__input" id="star-rating-1" type="radio"
                                                            name="rate" value="1">
                                                        <label class="star-rating__ico fa fa-star-o" for="star-rating-1"
                                                            title="1 out of 5 stars"></label>
                                                    </div>
                                                </div>
                                                @error('rate')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review" class="form-label">Ulasan Anda</label>
                                            <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-dark">Submit Ulasan</button>
                                    </form>
                                @else
                                    <div class="text-center py-4">
                                        <p>You need to <a href="{{ route('login.form') }}"
                                                class="text-decoration-none">Login</a> or
                                            <a href="{{ route('register.form') }}" class="text-decoration-none">Register</a>
                                            to write a review
                                        </p>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Customer Reviews -->
                        <div class="customer-reviews">
                            <h4 class="mb-4">Ulasan Customer</h4>
                            @foreach ($product_detail['getReview'] as $review)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                                @if ($review->user_info['photo'])
                                                    <img src="{{ $review->user_info['photo'] }}"
                                                        alt="{{ $review->user_info['name'] }}" class="rounded-circle"
                                                        width="50" height="50">
                                                @else
                                                    <img src="{{ asset('backend/img/avatar.png') }}" alt="Profile"
                                                        class="rounded-circle" width="50" height="50">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-1">{{ $review->user_info['name'] }}</h5>
                                                <div class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($review->rate >= $i)
                                                            <i class="fa fa-star text-warning"></i>
                                                        @else
                                                            <i class="fa fa-star-o text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0">{{ $review->review }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2>Rekomendasi Untuk Kamu</h2>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($product_detail->rel_prods as $data)
                    @if ($data->id !== $product_detail->id)
                        <div class="col">
                            <div class="card text-center h-100">
                                @php
                                    $photo = explode(',', $data->photo);
                                @endphp
                                <a href="{{ route('product-detail', $data->slug) }}">
                                    <img src="{{ $photo[0] }}" class="card-img-top img-fluid"
                                        alt="{{ $photo[0] }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a class="text-decoration-none text-dark"
                                            href="{{ route('product-detail', $data->slug) }}">{{ $data->title }}</a>
                                    </h5>
                                    <p class="text-muted">
                                        <span
                                            class="text-decoration-line-through">Rp{{ number_format($data->price, 2) }}</span>
                                        <span
                                            class="fw-bold text-danger">Rp{{ number_format($data->price - ($data->discount * $data->price) / 100, 2) }}</span>
                                    </p>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('add-to-wishlist', $data->slug) }}"
                                            class="btn btn-outline-danger"><i class="fa fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </section>

@endsection


@push('scripts')
    <script>
        // script for add and minus
        const decrement = document.getElementById('decrement');
        const increment = document.getElementById('increment');
        const quantity = document.getElementById('quantity');
        decrement.addEventListener('click', function() {
            if (quantity.value > 1) {
                quantity.value--;
            }
        });
        increment.addEventListener('click', function() {
            quantity.value++;
        });
    </script>
@endpush
