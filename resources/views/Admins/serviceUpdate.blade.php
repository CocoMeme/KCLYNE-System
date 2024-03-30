    @extends('layouts.header')

    <body>

        @if(session('success'))
            <div class="success-message-admin">
                {{ session('success') }}
            </div>
        @endif

    <section class="product-management">

        {{-- Service UPDATE --}}
        <div class="create-product">
        <form class="form-create-product" action="{{ route('service.update', $service->id) }}" method="PUT" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h2 style="text-align: center;">Update Service</h2>

            <div class="group">
            <label for="service_name">Service Name:</label>
            <input name="service_name" type="text" placeholder="Enter the service name" value="{{ old('service_name', $service->service_name) }}" required>
            </div>
            @error('service_name')
            <span class="error">{{ $message }}</span>
            @enderror

            <div class="group">
            <label for="description">Description:</label>
            <textarea name="description" placeholder="Enter the service Description" rows="5">{{ old('description', $service->description) }}</textarea>
            @error('description')
            <span class="error">{{ $message }}</span>
            @enderror
            </div>

            <div class="group">
            <label for="price">Price:</label>
            <input name="price" type="number" placeholder="Enter the Price"  value="{{ old('price', $service->price) }}" required>
            </div>
            @error('price')
            <span class="error">{{ $message }}</span>
            @enderror

            <div class="group">
            <label for="images">Service Images:</label>
            <input type="file" name="images[]" id="images" multiple>
            
            </div>

            {{-- Display existing images --}}
            <div class="group">
            <label>Existing Images:</label><br>
            @if($service->image)
                @foreach(explode('|', $service->image) as $image)
                <img src="{{ asset('images/'.$image) }}" class="existing-image" alt="{{ $image }}">
                @endforeach
            @else
                No Existing Images
            @endif
            </div>

            <button type="submit">Update</button>
        </form>
        </div>

    </section>

    </body>
