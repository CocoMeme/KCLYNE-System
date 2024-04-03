@extends('Layouts/header')
@extends('Layouts/footer')

<body>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <section class="services">
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
            </div>
        @endforeach
        
    </section>

    {{-- <section>
        <form action="{{route('customer.service')}}" method="GET" class="mt-4">
                <input type="text" name="search" placeholder="Search a Services" class="border border-gray-400 rounded-md px-4 py-2 focus:outline-none focus:border-blue-500">
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md ml-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Search</button>
        </form> 
    </section> --}}

</body>
