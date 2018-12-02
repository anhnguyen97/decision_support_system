@extends('shop.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('shop/plugins/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_responsive.css') }}">
@endsection
@section('content')
<div class="container single_product_container">
	<div class="row">
		<div class="col">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="{{ asset('') }}">Home</a></li>
					<li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Product</a></li>
					<li class="active"><a href="{{ asset('') }}{{$product->slug}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Single Product</a></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="row">
		<div class="col-lg-6">
			<div class="single_product_pics">
				<div class="row" >
					<div class="col-2"> </div>
					<img src="http://dss.me/{{$product->thumbnail}}" alt="{{$product->name}}" class="img-responsive" style="height: 350px;">
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="product_details">
				<div class="product_details_title">
					<h2>{{$product->name}}</h2>
					<p>Brand: {{$product->brand->name}}</p>
				</div>
				{{-- <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
					<span class="ti-truck"></span><span>free delivery</span>
				</div> --}}
				@if ($product->discount>0)
				<div class="original_price">VND {{$product->cost*(1+$product->discount/100)}}</div>
				@endif				
				<div class="product_price">VND {{$product->cost}}</div>
				<ul class="star_rating">
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star" aria-hidden="true"></i></li>
					<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
				</ul>
				<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
					<span>Quantity:</span>
					<div class="quantity_selector">
						<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
						<span id="quantity_value">1</span>
						<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
					</div>
					<button type="button" class="btn btn-danger " style="margin-left: 15px"> add to cart</button>
					{{-- <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div> --}}
					<div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Tabs -->

<div class="tabs_section_container">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="tabs_container">
					<ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
						<li class="tab active" data-active-tab="tab_1"><span>Additional Information</span></li>
						<li class="tab" data-active-tab="tab_2"><span>Brand</span></li>
						<li class="tab" data-active-tab="tab_3"><span>Reviews</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<!-- Tab Additional Info -->

				<div id="tab_1" class="tab_container active">
					<div class="row">
						<div class="col additional_info_col text-center" style="color: blue">
							<div class="tab_title additional_info_title">
								<h4>Additional Information</h4>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-6">
							<table class="table table-hover">
								<tr>
									<td>Hệ điều hành</td>
									<td>{{$product->os}}</td>
								</tr>
								<tr>
									<td>Camera trước</td>
									<td>{{$product->detail->camera_font}} MP</td>
								</tr>
								<tr>
									<td>Camera sau</td>
									<td>{{$product->detail->camera_rear}} MP</td>
								</tr>
								<tr>
									<td>CPU</td>
									<td>{{$product->detail->cpu_speed}} GHz</td>
								</tr>
								<tr>
									<td>Ram</td>
									<td>{{$product->detail->ram}} GB</td>
								</tr>
								<tr>
									<td>Bộ nhớ trong</td>
									<td>{{$product->detail->internal_memory}} GB</td>
								</tr>
								
							</table>
						</div>
						<div class="col-6">
							<table class="table table-hover">
								<tr>
									<td>Màn hình</td>
									<td>{{$product->detail->screen_size}} ''</td>
								</tr>
								<tr>
									<td>Dung lượng pin</td>
									<td>{{$product->detail->battery}} mAh</td>
								</tr>
								<tr>
									<td>Trọng lượng</td>
									<td>{{$product->detail->weight}} g</td>
								</tr>
								<tr>
									<td>Kích thước</td>
									<td>Dài {{$product->detail->length}} mm - Ngang {{$product->detail->width}} mm - Dày {{$product->detail->thickness}} mm</td>
								</tr>
								<tr>
									<td>Bluetooth</td>
									<td>{{$product->detail->bluetooth}}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>

				<!-- Tab Brand -->

				<div id="tab_2" class="tab_container ">
					<div class="row">
						<div class="col-lg-5 desc_col">
							<div class="tab_title">
								<h4>Brand</h4>
							</div>
							<div class="tab_text_block">
								<h2>{{$product->brand->name}}</h2>
								<p>{{$product->brand->description}}</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Tab Reviews -->

				<div id="tab_3" class="tab_container">
					<div class="row">

						<!-- User Reviews -->

						{{-- <div class="col-lg-6 reviews_col">
							<div class="tab_title reviews_title">
								<h4>Reviews</h4>
							</div>

							<!-- User Review -->

							<div class="user_review_container d-flex flex-column flex-sm-row">
								<div class="user">
									<div class="user_pic"></div>
									<div class="user_rating">
										<ul class="star_rating">
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										</ul>
									</div>
								</div>
								<div class="review">
									<div class="review_date">27 Aug 2016</div>
									<div class="user_name">Brandon William</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>

							<!-- User Review -->

							<div class="user_review_container d-flex flex-column flex-sm-row">
								<div class="user">
									<div class="user_pic"></div>
									<div class="user_rating">
										<ul class="star_rating">
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										</ul>
									</div>
								</div>
								<div class="review">
									<div class="review_date">27 Aug 2016</div>
									<div class="user_name">Brandon William</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div> --}}

						<!-- Add Review -->
						<div class="col-1" style="height: 0"></div>
						<div class="col-lg-10 add_review_col">

							<div class="add_review">
								<form id="review_form" action="post">
									<div>
										<h1>Add Review</h1>
										<input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
										<input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
									</div>
									<div>
										<h1>Your Rating:</h1>
										<ul class="user_star_rating">
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star" aria-hidden="true"></i></li>
											<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
										</ul>
										<textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
									</div>
									<div class="text-left text-sm-right">
										<button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
									</div>
								</form>
							</div>

						</div>

					</div>
				</div>

			</div>
		</div>
	</div>

</div>
@endsection
@section('js')
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/single_custom.js') }}"></script>
@endsection