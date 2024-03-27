@extends('Layouts/header')

<body>

    @auth('admin') 
    <section class="product-management">

        {{-- PRODUCT CREATE --}}

        <div class="create-product">
            <form class="form-create-product" action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h2 style="text-align: center;">Product Information</h2>
                <div class="group">
                    <label for="product_name">Product Name:</label>
                    <input name="product_name" type="text" placeholder="Enter the product name" required>
                </div>
                @error('product_name')
                    <span class="error">{{ $message }}</span>
                @enderror

                <div class="group">
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Enter the product Description" cols="30" rows="10" required></textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="group">
                    <label for="supplier_price">Supplier Price:</label>
                    <input name="supplier_price" type="number" placeholder="Enter the supplier price" required>
                    @error('supplier_price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="group">
                    <label for="seller_retail_price">Seller Retail Price:</label>
                    <input name="seller_retail_price" type="number" placeholder="Enter the seller retail price" required>
                    @error('seller_retail_price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="group">
                    <label for="category">Category:</label>
                    <select name="category" required>
                        <option value="Oil">Oil</option>
                        <option value="Spare Part">Spare Part</option>
                        <option value="Tires & Wheels">Tires & Wheels</option>
                    </select>
                    @error('category')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="group">
                    <label for="stock">Stock:</label>
                    <input name="stock" type="number" placeholder="Enter the stock" required>
                    @error('stock')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="group">
                    <label for="Image">Insert Image:</label>
                    <input type="file" name="images[]" id="images" multiple>
                    @error('images')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
        
                <button type="submit">Create</button>
            </form>
        </div>
        
        {{-- PRODUTC DISPLAY --}}

        <div class="show-product">
            <h2 style="text-align: center;">All Products</h2>
            <div class="products">
                @foreach($products as $product)
                <div class="row">
                    @php
                    // Split the product_image string into an array of image names
                    $images = explode('|', $product->product_image);
                    @endphp
                    @if(count($images) > 0)
                    <img src="{{ asset('Images/Products/' . $images[0]) }}" alt="Product Image" style="max-width: 100px;">
                    @endif
                    <h3>{{ $product->product_name }}</h3>
                    <p>{{ $product->seller_retail_price }}</p>
                </div>
                @endforeach
            </div>
        </div>
        

        @else  

        @endauth

            
    </section>
</body>