@extends('Layouts/header')
@extends('Layouts/footer')

<body>

    @if(session('success'))
        <div class="success-message-admin">
            {{ session('success') }}
        </div>
    @endif

    @auth('customer') 
        <section class="product-shop">
            
            {{-- PRODUTC DISPLAY --}}
            <div class="display-product">


                <div class="products">
                    @foreach($products as $product)
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
                                    <label name="Stat" for="">Supplier Price:</label><p> ₱ {{$product->supplier_price}}</p>
                                </div>

                                <div class="form-group">
                                    <label name="Stat" for="">SRP:</label><p> ₱ {{ $product->seller_retail_price }}</p>
                                </div>

                                <div class="form-group">
                                    <label name="Stat" for="">Stocks:</label><p> -- </p>
                                </div>

                                <p name="description">{{ $product->description }}</p>

                            </div>

                            <div class="form-group-button">

                                    <button name="update" type="submit" class="btn btn-primary">Buy Now</button>
                                    <button name="delete" type="submit" class="btn btn-danger">Add to Cart</button>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    @else  

    @endauth

</body>
</html>