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
</head>
<body class=" detail page ">

	<!--main area-->
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>detail</span></li>
				</ul>
			</div>
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							<div class="product-gallery">
							<ul class="slides">
								@php
								$images = explode('|', $product->product_image);
								@endphp
								@foreach($images as $image)
									<li data-thumb="{{ asset('Images/Products/' . trim($image)) }}">
										<img src="{{ asset('Images/Products/' . trim($image)) }}" alt="product thumbnail" />
									</li>
								@endforeach
							</ul>
							</div>
						</div>

						<div class="detail-info">
							<div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 review)</a>
                            </div>
							<h2 class="product_name">{{ $product->product_name }}</h2>
                            <div class="short-desc">
							<p name="description">{{ $product->description }}</p>
                            </div>
                            <div class="wrap-social">
                            	<a class="link-socail" href="#"><img src="assets/images/social-list.png" alt=""></a>
                            </div>
                            <div class="wrap-price">
								<span class="product-price">
								₱ {{ $product->seller_retail_price }}
								</span>
							</div>
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>In Stock</b></p>
                            </div>
                            <div class="quantity">
                            	<span>Quantity:</span>
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >
									
									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div>
							<div class="wrap-butons">
								<a href="#" class="btn buy-now">Buy Now</a>
								<a href="#" class="btn add-to-cart" onclick="addToCart({{ $product->id }}, {{ auth()->guard('customer')->user()->id }})">Add to Cart</a>
								<div class="wrap-btn">
									<a href="#" class="btn btn-compare">Add Compare</a>
									<a href="#" class="btn btn-wishlist">Add Wishlist</a>
								</div>
							</div>

						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">description</a>
								<a href="#review" class="tab-control-item">Reviews</a>
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
								<p name="description">{{ $product->description }}</p>
								</div>
								
								<div class="tab-content-item " id="review">
									
									<div class="wrap-review-form">
										
										<div id="comments">
											<h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw Omnidirectional [Orage]</span></h2>
											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container"> 
														<img alt="" src="assets/images/author-avata.jpg" height="80" width="80">
														<div class="comment-text">
															<div class="star-rating">
																<span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
															</div>
															<p class="meta"> 
																<strong class="woocommerce-review__author">admin</strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" >Tue, Aug 15,  2017</time>
															</p>
															<div class="description">
																<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
															</div>
														</div>
													</div>
												</li>
											</ol>
										</div><!-- #comments -->

										<div id="review_form_wrapper">
											<div id="review_form">
												<div id="respond" class="comment-respond"> 

													<form action="#" method="post" id="commentform" class="comment-form" novalidate="">
														<p class="comment-notes">
															<span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>
														</p>
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1">
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2">
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3">
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4">
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															</p>
														</div>
														<p class="comment-form-author">
															<label for="author">Name <span class="required">*</span></label> 
															<input id="author" name="author" type="text" value="">
														</p>
														<p class="comment-form-email">
															<label for="email">Email <span class="required">*</span></label> 
															<input id="email" name="email" type="email" value="" >
														</p>
														<p class="comment-form-comment">
															<label for="comment">Your review <span class="required">*</span>
															</label>
															<textarea id="comment" name="comment" cols="45" rows="8"></textarea>
														</p>
														<p class="form-submit">
															<input name="submit" type="submit" id="submit" class="submit" value="Submit">
														</p>
													</form>

												</div><!-- .comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget widget-our-services ">
						<div class="widget-content">
							<ul class="our-services">

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-truck" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Free Shipping</b>
											<span class="subtitle">On Oder Over $99</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-gift" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Special Offer</b>
											<span class="subtitle">Get a gift!</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>

								<li class="service">
									<a class="link-to-service" href="#">
										<i class="fa fa-reply" aria-hidden="true"></i>
										<div class="right-content">
											<b class="title">Order Return</b>
											<span class="subtitle">Return within 7 days</span>
											<p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div><!-- Categories widget-->

<script src="{{ asset('JavaScript/jquery-1.12.4.minb8ff.js') }}"></script>
<script src="{{ asset('JavaScript/jquery-ui-1.12.4.minb8ff.js') }}"></script>
<script src="{{ asset('JavaScript/bootstrap.min.js') }}"></script>
<script src="{{ asset('JavaScript/jquery.flexslider.js') }}"></script>
<script src="{{ asset('JavaScript/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('JavaScript/owl.carousel.min.js') }}"></script>
<script src="{{ asset('JavaScript/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('JavaScript/jquery.sticky.js') }}"></script>
<script src="{{ asset('JavaScript/functions.js') }}"></script>

<script>
function addToCart(productId, customerId) {
    // Retrieve the quantity from the input field
    var quantity = parseInt($('.quantity-input input[name="product-quatity"]').val());

    // Send an AJAX request to the server
    $.ajax({
        type: "POST",
        url: "{{ route('addToCart') }}", // Replace 'addToCart' with the actual route name
        data: {
            product_id: productId,
            customer_id: customerId,
            quantity: quantity // Include the quantity
        },
        success: function(response) {
            // Handle success response
            alert('Product added to cart successfully!');
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(error);
            alert('An error occurred while adding the product to cart.');
        }
    });
}
</script>

</body>
</html>