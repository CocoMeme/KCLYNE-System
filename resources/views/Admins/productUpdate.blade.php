@extends('Layouts/header')

<body>

    @auth('admin') 
    <section class="product-management">

        {{-- PRODUCT UPDATE --}}
        <div class="create-product">
            <form class="form-create-product" action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2 style="text-align: center;">Product Information</h2>
                <div class="group">
                    <label for="product_name">Product Name:</label>
                    <input name="product_name" type="text" placeholder="Enter the product name" value="{{ $product->product_name }}" required>
                    @error('product_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="group">
                    <label for="description">Description:</label>
                    <textarea name="description" placeholder="Enter the product Description" cols="30" rows="10" required>{{ $product->description }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="group">
                    <label for="supplier_price">Supplier Price:</label>
                    <input name="supplier_price" type="number" placeholder="Enter the supplier price" value="{{ $product->supplier_price }}" required>
                    @error('supplier_price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="group">
                    <label for="seller_retail_price">Seller Retail Price:</label>
                    <input name="seller_retail_price" type="number" placeholder="Enter the seller retail price" value="{{ $product->seller_retail_price }}" required>
                    @error('seller_retail_price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="group">
                    <label for="category">Category:</label>
                    <select name="category" required>
                        <option value="Oil" {{ $product->category == 'Oil' ? 'selected' : '' }}>Oil</option>
                        <option value="Spair Part" {{ $product->category == 'Spair Part' ? 'selected' : '' }}>Spair Part</option>
                        <option value="Tires & Wheels" {{ $product->category == 'Tires & Wheels' ? 'selected' : '' }}>Tires & Wheels</option>
                    </select>
                    @error('category')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            
                <div class="group">
                    <label for="stock">Stock:</label>
                    <input name="stock" type="number" placeholder="Enter the stock" value="{{ $product->stock }}" required>
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
            
                <button name="update" type="submit">Update</button> <!-- Change button text to "Update" -->
            </form>
        </div>
        
        {{-- PRODUTC DISPLAY --}}
        <div class="show-product">
            <h2 style="text-align: center;">All Products</h2>

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
                        <form action="{{ route('product.edit', ['id' => $product->id]) }}" method="GET">
                            @csrf
                            <button name="update" type="submit" class="btn btn-primary">Update</button>
                        </form>
                    
                        <form action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button name="delete" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>

            @endforeach
            
            </div>

        </div>
        
        @else  

        @endauth

    </section>


</body>

</html>