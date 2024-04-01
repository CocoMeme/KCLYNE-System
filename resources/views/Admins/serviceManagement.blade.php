@extends('Layouts/header')

<body>

  <section class="service-management">

    {{-- Service CREATE --}}
    <div class="create-service">
      <form class="form-create-service" action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <h2 style="text-align: center;">Service Information</h2>

        <div class="group">
          <label for="service_name">Service Name:</label>
          <input name="service_name" type="text" placeholder="Enter the service name" required>
        </div>
        @error('service_name')
        <span class="error">{{ $message }}</span>
        @enderror

        <div class="group">
          <label for="description">Description:</label>
          <textarea name="description" placeholder="Enter the service Description" cols="30" rows="10" required></textarea>
          @error('description')
          <span class="error">{{ $message }}</span>
          @enderror
        </div>

        <div class="group">
          <label for="price">Price:</label>
          <input name="price" type="number" placeholder="Enter the Price" required>
        </div>
        @error('price')
        <span class="error">{{ $message }}</span>
        @enderror

        <div class="group">
          <label for="images">Service Images:</label>
          <input type="file" name="images[]" id="images" multiple required>
          @error('images')
          <span class="error">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit">Save</button>
      </form>
    </div>

    {{-- SERVICE DISPLAY --}}

    <div class="services">

        @foreach($service as $service)
          <div class="row">

            @php
              $imagesExist = false;
              $existingImages = explode('|', $service->image); // Store existing images
            @endphp

            @if(count($existingImages) > 0)
              @foreach ($existingImages as $image)
                @if(file_exists(public_path('Images/Services/' . $image)))
                  <img src="{{ asset('Images/Services/' . $image) }}" alt="Service Image" width="100px">
                  @php $imagesExist = true; @endphp
                  @break
                @endif
              @endforeach
            @endif

            @if(!$imagesExist)
              <img src="{{ asset('Images/Services/no_product_image.jpg') }}" alt="No Service Image" width="100px">
            @endif

            <h3>{{ $service->service_name }}</h3>

            <div class="service-info">

              <div class="form-group">
                <label name="Stat" for="">Price:</label><p> ₱ {{$service->price}}</p>
              </div>

              <p name="description">{{ $service->description }}</p>

            </div>

            <form action="{{ route('service.edit', ['id' => $service->id]) }}" method="GET">
              @csrf
              <button name="update" type="submit" class="btn btn-primary">Update</button>
            </form>

            <form action="{{ route('service.destroy', ['id' => $service->id]) }}" method="DELETE">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-primary">Delete</button>
            </form>

          </div>
        @endforeach

      </div>

  </div>

</section>

</body>
