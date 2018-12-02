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
					<li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Suggestion</a></li>
					<li class="active"><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Result</a></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="new_arrivals">
		<div class="row">				
			<!-- Product 1 -->
			@foreach ($mobiles as $item)
			<div class="col-3">
				<div class="product discount product_filter">
					<div class="product_name">
						<img src="http://dss.me/{{$item->thumbnail}}" alt="" style="width: 80%; padding-left: 10%" class="img-responsive">
					</div>
					<div class="favorite favorite_left"></div>
					@if ($item->discount>0)
					<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>
						{{'-$'. $item->discount*$item->cost/2000000}}
					</span></div>
					@endif
					<div class="product_info">
						<h6 class="product_name"><a href="{{ asset('') }}{{$item->slug}}">{{$item->name}}</a></h6>
						<div class="product_price">VND {{$item->cost}}<span></span></div>
					</div>
				</div>
				<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
			</div>
			@endforeach
		</div>
	</div>

</div>
@endsection
@section('js')
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/single_custom.js') }}"></script>
@endsection