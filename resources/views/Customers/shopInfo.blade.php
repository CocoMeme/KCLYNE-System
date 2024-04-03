@extends('Layouts/header')
@extends('Layouts/footer')

<body>

    <section class="product-shop">
    
        <div class="product-info">

            <div class="form-group">
                <label name="Stat" for="">SRP:</label><p> ₱ {{ $product->seller_retail_price }}</p>
            </div>

            <div class="form-group">
                <label name="Stat" for="">Stocks:</label><p> - - - {{ $product->stock->product_stock }}</p>
            </div>

            <p name="description">{{ $product->description }}</p>

        </div>

    </section>
</body>