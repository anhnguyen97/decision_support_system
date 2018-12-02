@extends('shop.layouts.master')
@section('content')
<!-- Deal of the week -->

<div class="deal_ofthe_week" style="margin-top: 150px;">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="deal_ofthe_week_img">
					<img src="{{ asset('shop/images/Mobile-PNG-Image.png') }}" alt="" style="height: 380px; padding-top: 10px">
				</div>
			</div>
			<div class="col-lg-6 text-right deal_ofthe_week_col">
				<div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
					<div class="section_title">
						<h2>Deal Of The Week</h2>
					</div>
					<ul class="timer">
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="day" class="timer_num">03</div>
							<div class="timer_unit">Day</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="hour" class="timer_num">15</div>
							<div class="timer_unit">Hours</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="minute" class="timer_num">45</div>
							<div class="timer_unit">Mins</div>
						</li>
						<li class="d-inline-flex flex-column justify-content-center align-items-center">
							<div id="second" class="timer_num">23</div>
							<div class="timer_unit">Sec</div>
						</li>
					</ul>
					<div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Banner -->

<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="banner_item align-items-center" style="background-image:url({{ asset('shop/images/top-brand.png') }})">
					<div class="banner_category">
						<a href="">Top Brand</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="banner_item align-items-center" style="background-image:url({{ asset('shop/images/best-sellers.png') }})">
					<div class="banner_category">
						<a href="">Best Sellers</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="banner_item align-items-center" style="background-image:url({{ asset('shop/images/new-arrivals.png') }})">
					<div class="banner_category">
						<a href="">New Arrivals</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- All Arrivals -->

<div class="new_arrivals">
	<div class="container">
		<div class="row clearfix">
			<div class="col text-center">
				<div class="section_title new_arrivals_title">
					<h2>All Product</h2>
				</div>
			</div>
		</div>
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
		<div class="text-center">
			{{ $mobiles->links() }}
		</div>
	</div>
</div>

@endsection
