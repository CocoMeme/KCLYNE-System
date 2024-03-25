@extends('Layouts/header')

<body>

    @auth('admin') 
    <section class="product-management">

            <div class="create-product">
                <form class="form-create-product" action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Create Product</h2>
                <div class="group">
                    {{-- <label for="">Product Name:</label> --}}
                    <input name="name" type="text" placeholder="Enter the product name">
                </div>

                <div class="group">
                    {{-- <label for="">Price:</label> --}}
                    <input name="price" type="integer" placeholder="Enter the price">
                </div>

                <div class="group">
                    {{-- <label for="">Seller Price:</label> --}}
                    <input name="seller_price" type="integer" placeholder="Enter the seller Price">
                </div>

                <div class="group">
                    {{-- <label for="">Stock:</label> --}}
                    <input name="stock" type="integer" placeholder="Enter the stock">
                </div>

                <div class="group">
                    {{-- <label for="">Description:</label> --}}
                    <textarea name="description" placeholder="Enter the product Description" cols="30" rows="10"></textarea>
                </div>

                <div class="group">
                    {{-- <label for="">Insert Image:</label> --}}
                    <input type="file" name="image" id="image">
                </div>

                <button>Create</button>
                </form>
            </div>

        {{-- <div class="create-product">
            <form class="form-create-product" action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Production</h2>

                <div class="group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" required>
                </div>
                <div class="group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="group">
                    <label for="supplier_price">Supplier Price:</label>
                    <input type="number" id="supplier_price" name="supplier_price" required>
                </div>
                <div class="group">
                    <label for="seller_retail_price">Seller Retail Price:</label>
                    <input type="number" id="seller_retail_price" name="seller_retail_price" required>
                </div>
                <div class="group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" required>
                </div>
                <div class="group">
                    <label for="product_image">Product Image:</label>
                    <input type="file" id="product_image" name="product_image" required>
                </div>
            <button type="submit">Submit</button>
            </form>
        </div>     --}}
        
        <div class="show-product">
            <h2 style="text-align: center;">All Products</h2>
            <div class="products">
                {{-- @foreach($products as $product)
                    <div class="row">
                        <img src="{{ asset('images/products/' . $product->image) }}" alt="Product Image" style="max-width: 100px;">
                        <h3>{{$product['name']}}</h3>
                        {{$product['price']}}
                        {{$product['description']}}
                    </div>
                @endforeach     --}}
            </div>
        </div>

        @else  

        @endauth

            
    </section>
</body>