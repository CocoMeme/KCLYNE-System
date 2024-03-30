@extends('Layouts/header')

<body>      

  @if(session('success'))
    <div class="success-message-admin">
        {{ session('success') }}
    </div>
  @endif

  <section class="product-management">

    {{-- Service CREATE --}}
    <div class="create-product">
      <form class="form-create-product" action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">

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
    <div class="show-product">
      <h2>All Services</h2>


      @if (!is_null($service) && count($service) > 0)
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($service as $service)
          <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->service_name }}</td>
            <td>{{ $service->description }}</td>
            <td>{{ $service->price }}</td>
            <td>
          @if($service->image)
              @php
                  $imageArray = explode('|', $service->image);
                  $firstImage = $imageArray[0];
              @endphp
              <img src="{{ asset('Images/Services/'. $firstImage) }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="{{ $firstImage }}">
          @else
              <img src="{{ asset('Images/Services/no_service_image.jpg') }}" alt="">
          @endif
      </td>

            <td style="align-text: center">
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="{{ route('service.update', $service->id) }}">
                  <span class="fas fa-edit text-primary"></span> Edit
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('service.destroy', $service->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item delete_data text-danger">
                    <span class="fas fa-trash"></span> Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <p>No services found.</p>
      @endif
    </div>

  </section>

</body>
