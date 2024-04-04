@extends('Layouts/header')
@extends('Layouts/footer')

<body>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif


    {{-- ADMIN DASHBAORD --}}
    @auth('admin')
        
        <section class="main-home">
            <div class="main-text">
                <h5 style="font-size: 20px">KCLYNE</h5>
                <h1 style="color: rgb(74, 83, 118)">LIQUI MOLY<br></h1>
                <h1>SHOPPING 2024</h1>
                <p>New Collections Featured</p>

                <a href="/shop" class="main-btn">Shop Now! <i class='bx bxs-chevron-right'></i></a>
            </div>
        </section>

        <section class="search-products">
        
        </section>

    @endauth


    {{-- CUSTOMER & VISITOR --}}

    @auth('customer')
        
        <section class="main-home">
            <div class="main-text">
                <h5 style="font-size: 20px">KCLYNE</h5>
                <h1 style="color: rgb(74, 83, 118)">LIQUI MOLY<br></h1>
                <h1>SHOPPING 2024</h1>
                <p>New Collections Featured</p>

                <a href="/shop" class="main-btn">Shop Now! <i class='bx bxs-chevron-right'></i></a>
            </div>
        </section>

        <section class="search-products">
            @isset($searchQuery)
                @forelse ($searchedProducts as $product)
                    <a href="{{ route('shopInfo', ['id' => $product->id]) }}">
                        <div class="row">
                            @php
                                $imagesExist = false;
                                $images = explode('|', $product->product_image);
                            @endphp
                            @if(count($images) > 0)
                                @foreach ($images as $image)
                                    @if(file_exists(public_path('Images/Products/' . $image)))
                                        <img src="{{ asset('Images/Products/' . $image) }}" alt="Product Image" width="100px">
                                        @php $imagesExist = true; @endphp
                                        @break
                                    @endif
                                @endforeach
                            @endif
                            @if(!$imagesExist)
                                <img src="{{ asset('Images/Products/no_product_image.jpg') }}" alt="No Product Image" width="100px">
                            @endif
                            <h3>{{ $product->product_name }}</h3>
                            <div class="product-info">
                                <div class="form-group">
                                    <label name="Stat" for="">SRP:</label><p> ₱ {{ $product->seller_retail_price }}</p>
                                </div>
                                <div class="form-group">
                                    <label name="Stat" for="">Stocks:</label><p> - - - {{ $product->stock->product_stock }}</p>
                                </div>
                                <p name="description">{{ $product->description }}</p>
                            </div>
                        </div>
                    </a>    
                @empty
                    <p>No products found.</p>
                @endforelse
            @endisset
        </section>
        

        {{-- VISITOR --}}

        @else 

            <section class="main-home">
                <div class="main-text">
                    <h5 style="font-size: 20px">KCLYNE</h5>
                    <h1 style="color: rgb(74, 83, 118)">LIQUI MOLY<br></h1>
                    <h1>SHOPPING 2024</h1>
                    <p>New Collections Featured</p>

                    <a href="/shop" class="main-btn">Shop Now! <i class='bx bxs-chevron-right'></i></a>
                </div>
            </section>

            <section class="search-products">
                @isset($searchQuery)
                    @forelse ($searchedProducts as $product)
                        <a href="{{ route('shopInfo', ['id' => $product->id]) }}">
                            <div class="row">
                                @php
                                    $imagesExist = false;
                                    $images = explode('|', $product->product_image);
                                @endphp
                                @if(count($images) > 0)
                                    @foreach ($images as $image)
                                        @if(file_exists(public_path('Images/Products/' . $image)))
                                            <img src="{{ asset('Images/Products/' . $image) }}" alt="Product Image" width="100px">
                                            @php $imagesExist = true; @endphp
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                                @if(!$imagesExist)
                                    <img src="{{ asset('Images/Products/no_product_image.jpg') }}" alt="No Product Image" width="100px">
                                @endif
                                <h3>{{ $product->product_name }}</h3>
                                <div class="product-info">
                                    <div class="form-group">
                                        <label name="Stat" for="">SRP:</label><p> ₱ {{ $product->seller_retail_price }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label name="Stat" for="">Stocks:</label><p> - - - {{ $product->stock->product_stock }}</p>
                                    </div>
                                    <p name="description">{{ $product->description }}</p>
                                </div>
                            </div>
                        </a>    
                    @empty
                        <p>No products found.</p>
                    @endforelse
                @endisset
            </section>

        @endauth


</body>