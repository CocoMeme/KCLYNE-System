<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KCLYNE</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/flexslider.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/chosen.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/color-01.css') }}" type="text/css" rel="stylesheet">

	<link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="{{ asset('css/header-footer.css') }}" rel="stylesheet">
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-increase').click(function(e) {
            e.preventDefault();
            var input = $(this).siblings('input.product-quantity');
            var currentValue = parseInt(input.val());
            var maxValue = parseInt(input.attr('data-max'));
            if (currentValue < maxValue) {
                input.val(currentValue + 1);
                input.trigger('input'); // Trigger input event to recalculate subtotal
            }
        });

        $('.btn-reduce').click(function(e) {
            e.preventDefault();
            var input = $(this).siblings('input.product-quantity');
            var currentValue = parseInt(input.val());
            if (currentValue > 1) {
                input.val(currentValue - 1);
                input.trigger('input'); // Trigger input event to recalculate subtotal
            }
        });

        $('.product-quantity').on('input', function() {
            var quantity = parseInt($(this).val());
            var price = parseFloat($(this).closest('.pr-cart-item').find('.produtc-price .price').text().replace('₱', ''));
            var subtotal = quantity * price;
            $(this).closest('.pr-cart-item').find('.sub-total .price').text('₱' + subtotal.toFixed(2));
            updateTotal();
        });

        function updateTotal() {
            var total = 0;
            $('.sub-total .price').each(function() {
                total += parseFloat($(this).text().replace('₱', ''));
            });
            $('.total-info .index').text('₱' + total.toFixed(2));
        }
    });
</script>

<script>
    // Add an event listener for the checkout button click
    document.getElementById('checkoutBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default action of the link

        // Perform an AJAX request to call the checkout function
        // Replace 'checkout' with the actual route name of the checkout function
        fetch('{{ route('checkout') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token
            }
        })
        .then(response => {
            if (response.ok) {
                // Redirect to the success page
                window.location.href = '{{ route('shop') }}';
            } else {
                // Redirect to the error page
                window.location.href = '{{ route('cartInfo') }}';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Redirect to the error page
            window.location.href = '{{ route('cartInfo') }}';
        });
    });
</script>


<header>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <a href="/" class="logo"><img src="/Images/Layouts/KCLYNE-Logo.png" alt=""></a>

    <ul class="navmenu">
        <li><a href="/">Home</a></li>
        <li><a href="/shop">Shop</a></li>
        <li><a href="/customer-service">Services</a></li>
        <li><a href="/">About Us</a></li>
    </ul>

    <div class="search">
        <form action="{{ route('searchProducts') }}" method="GET">
            <input type="text" name="query" placeholder="Search a Product" value="{{ request()->input('query') }}">
            <button type="submit"><i class='bx bx-search-alt'></i></button>
        </form>
    </div>

    <div class="nav-icon">
        <a href="/cart">
            <i class='bx bx-cart-alt'></i>
        </a>
        <a href="/">
            <i class='bx bx-bell'></i>
        </a>
        <a href="">
            <i class='bx bxs-user-circle'></i>
        </a>
        <div class="logout-button">
            <form action="{{ route('customer.logout.submit') }}" method="POST">
                @csrf
                <a href="{{ route('customer.logout.submit') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class='bx bx-log-out-circle'></i>
                </a>
            </form>
        </div>
    </div>

</header>




<body class=" shopping-cart page " style="margin-top: 100px">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>


    <div class="container">
        <div class="mid-section main-info-area">
            <br><br>
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    @foreach($cartItems as $cartItem)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            @php
                                $images = explode('|', $cartItem->product->product_image);
                            @endphp
                            @foreach($images as $image)
                                <img src="{{ asset('Images/Products/' . trim($image)) }}" alt="product thumbnail" />
                                @break <!-- This will stop the loop after the first iteration -->
                            @endforeach
                        </div>
                        <div class="product-name">
                            <a class="link-to-product" href="#">{{ $cartItem->product->product_name }}</a>
                        </div>
                        <div class="price-field produtc-price"><p class="price">₱{{ $cartItem->product->seller_retail_price }}</p></div>
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="number" name="product-quantity" class="product-quantity" value="{{ $cartItem->quantity }}" data-max="120" min="1">
                                <a class="btn btn-increase" href="#">+</a>
                                <a class="btn btn-reduce" href="#">-</a>
                            </div>
                        </div>                        
                        <div class="price-field sub-total">
                            <p class="price">₱<span class="subtotal">{{ $cartItem->product->seller_retail_price * $cartItem->quantity }}</span></p>
                        </div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="">
                                <span>Delete from your cart</span>
                                <i class="bx bx-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    


        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">Order Summary</h4>
                @php
                    $subtotal = 0; // Initialize subtotal variable
                @endphp
                @foreach ($cartItems as $cartItem)
                    @php
                        // Calculate subtotal for each item
                        $subtotal += $cartItem->product->seller_retail_price * $cartItem->quantity;
                    @endphp
                @endforeach
                {{-- <p class="summary-info"><span class="title">Subtotal</span><b class="index">₱{{ number_format($subtotal, 2) }}</b></p>
                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p> --}}
                <p class="summary-info total-info"><span class="title">Total</span><b class="index">₱{{ number_format($subtotal, 2) }}</b></p>
            </div>
            <div class="checkout-info">
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-checkout">Check out</button>
                </form>
                <a class="link-to-shop" href="/shop">Continue Shopping<i class="bx bx" aria-hidden="true"></i></a>
            </div>
               
        </div>


			</div><!--end main content area-->
		</div><!--end container-->

	</main>

    <script src="{{ asset('JavaScript/jquery-1.12.4.minb8ff.js') }}"></script>
    <script src="{{ asset('JavaScript/jquery-ui-1.12.4.minb8ff.js') }}"></script>
    <script src="{{ asset('JavaScript/bootstrap.min.js') }}"></script>
    <script src="{{ asset('JavaScript/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('JavaScript/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('JavaScript/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('JavaScript/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('JavaScript/jquery.sticky.js') }}"></script>
    <script src="{{ asset('JavaScript/functions.js') }}"></script>


    @extends('layouts/footer')

</body>
</html>