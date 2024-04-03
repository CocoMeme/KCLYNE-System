@extends('Layouts/header')
@extends('Layouts/footer')

<body>
    
    <div class="product-info">

        <div class="form-group">
            <label name="Stat" for="">Supplier Price:</label><p> ₱ {{$product->supplier_price}}</p>
        </div>

        <div class="form-group">
            <label name="Stat" for="">SRP:</label><p> ₱ {{ $product->seller_retail_price }}</p>
        </div>

        <div class="form-group">
            <label name="Stat" for="">Stocks:</label><p> - - - {{ $product->stock->product_stock }}</p>
        </div>

        <p name="description">{{ $product->description }}</p>

    </div>


</body>