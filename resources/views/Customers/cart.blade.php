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
<body class=" shopping-cart page ">

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
								@endforeach
                    </div>
                    <div class="product-name">
                        <a class="link-to-product" href="#">{{ $cartItem->product->product_name }}</a>
                    </div>
                    <div class="price-field produtc-price"><p class="price">₱{{ $cartItem->product->seller_retail_price }}</p></div>
                    <div class="quantity">
                        <div class="quantity-input">
                            <input type="text" name="product-quatity" value="{{ $cartItem->quantity }}" data-max="120" pattern="[0-9]*">
                            <a class="btn btn-increase" href="#"></a>
                            <a class="btn btn-reduce" href="#"></a>
                        </div>
                    </div>
                    <div class="price-field sub-total">
                    <p class="price">₱{{ $cartItem->product->seller_retail_price * $cartItem->quantity }}</p>
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
						<p class="summary-info"><span class="title">Subtotal</span><b class="index">$512.00</b></p>
						<p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
						<p class="summary-info total-info "><span class="title">Total</span><b class="index">$512.00</b></p>
					</div>
					<div class="checkout-info">
						<a class="btn btn-checkout" href="checkout.html">Check out</a>
						<a class="link-to-shop" href="/shop">Continue Shopping<i class="bx bx" aria-hidden="true"></i></a>
					</div>
					<div class="update-clear">
						<a class="btn btn-clear" href="#">Clear Shopping Cart</a>
						<a class="btn btn-update" href="#">Update Shopping Cart</a>
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
	<!--footer area-->
</body>
</html>