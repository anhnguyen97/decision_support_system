@extends('shop.layouts.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/categories_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/categories_responsive.css') }}">
<style>
.slidecontainer {
	width: 100%;
}

.slider {
	-webkit-appearance: none;
	width: 100%;
	height: 15px;
	border-radius: 5px;
	background: #d3d3d3;
	outline: none;
	opacity: 0.7;
	-webkit-transition: .2s;
	transition: opacity .2s;
}

.slider:hover {
	opacity: 1;
}

.slider::-webkit-slider-thumb {
	-webkit-appearance: none;
	appearance: none;
	width: 25px;
	height: 25px;
	border-radius: 50%;
	background: #4CAF50;
	cursor: pointer;
}

.slider::-moz-range-thumb {
	width: 25px;
	height: 25px;
	border-radius: 50%;
	background: #4CAF50;
	cursor: pointer;
}
</style>
@endsection
@section('content')
<div class="container product_section_container">
	<div class="row">
		<div class="col product_section clearfix">

			<!-- Breadcrumbs -->

			<div class="breadcrumbs d-flex flex-row align-items-center">
				<ul>
					<li><a href="{{ asset('') }}">Home</a></li>
					<li class="active"><a href="{{ asset('') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Suggestion</a></li>
				</ul>
			</div>

			<!-- Sidebar -->

			<div class="sidebar">
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Brand</h5>
					</div>
					<ul class="sidebar_categories">
						<li><a href="#">Apple</a></li>
						<li class="active"><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>Women</a></li>
						<li><a href="#">Samsung </a></li>
						<li><a href="#">Oppo</a></li>
						<li><a href="#">Huawei </a></li>
						<li><a href="#">Vivo</a></li>
					</ul>
				</div>

				<!-- Price Range Filtering -->
				<div class="sidebar_section">
					<div class="sidebar_title">
						<h5>Filter by Price</h5>
					</div>
					<p>
						<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
					</p>
					<div id="slider-range"></div>
					<div class="filter_button"><span>filter</span></div>
				</div>

			</div>

			<!-- Main Content -->

			<div class="main_content">

				<!-- Products -->

				<div class="products_iso">
					<div class="row">
						<div class="col">

							<!-- Product Sorting -->

							<div class="product_sorting_container product_sorting_container_top">
								<ul class="product_sorting">
									<li>
										<span class="type_sorting_text">Default Sorting</span>
										<i class="fa fa-angle-down"></i>
										<ul class="sorting_type">
											<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
											<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
											<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Product Name</span></li>
										</ul>
									</li>
								</ul>
								<a class="btn btn-info" data-toggle="modal" href='#modal-id' style="float: right;">Suggest</a>
								<div class="modal fade" id="modal-id">
									<div class=" modal-dialog" style="width: 900px;">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Purcharse suggest</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>												
											</div>
											<div class="modal-body container-fluid">
												<form action="{{ asset('decisionSupport') }}" method="POST" role="form" id="formSupport" class="container-fluid">
													@csrf
													
													<table class="table table-content">
														<tr>
															<td>Battery</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="battery" min="1" max="100" value="1" class="slider" id="battery">
																	<p>Value: <span id="valBattery" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Camera (font - rear)</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="camera" min="1" max="100" value="1" class="slider" id="camera">
																	<p>Value: <span id="valCamera" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Cost</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="cost" min="1" max="100" value="1" class="slider" id="cost">
																	<p>Value: <span id="valCost" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Internal memory</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="internal" min="1" max="100" value="1" class="slider" id="internal">
																	<p>Value: <span id="valInternal" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Ram</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="ram" min="1" max="100" value="1" class="slider" id="ram">
																	<p>Value: <span id="valRam" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>CPU</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="cpu" min="1" max="100" value="1" class="slider" id="cpu">
																	<p>Value: <span id="valCPU" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Screen size</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="screenSize" min="1" max="100" value="1" class="slider" id="screenSize">
																	<p>Value: <span id="valScreenSize" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>External memory</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="external" min="1" max="100" value="1" class="slider" id="external">
																	<p>Value: <span id="valExternal" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Bluetooth</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="bluetooth" min="1" max="100" value="1" class="slider" id="bluetooth">
																	<p>Value: <span id="valBluetooth" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Demension <br> (Length, Width, Thickness)</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="demension" min="1" max="100" value="1" class="slider" id="demension">
																	<p>Value: <span id="valDemension" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
														<tr>
															<td>Weight</td>
															<td>
																<div class="slidecontainer">
																	<input type="range" name="weight" min="1" max="100" value="1" class="slider" id="weight">
																	<p>Value: <span id="valWeight" class="slider_label">1</span></p>
																</div>
															</td>
														</tr>
													</table>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary">See Result</button>
													</div>
												</div>
											</form>

										</div>
									</div>
								</div>	
							</div>

							<!-- Product Grid -->

							<div class="row" style="height: auto; margin: 50px 10px">

								<!-- Product 1 -->
								@foreach ($all_product as $product)
								<div class="col-4">
									<div class="product discount product_filter">
										<div class="product_image">
											<img src="http://dss.me/{{$product->thumbnail}}" style="width: 80%; padding-left: 10%" class="img-responsive">
										</div>
										<div class="favorite favorite_left"></div>
										@if ($product->discount>0)
										<div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
											<span>
												{{'-$'. $product->discount*$product->cost/2000000}}
											</span>
										</div>
										@endif
										<div class="product_info">
											<h6 class="product_name"><a href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> </a><a href="{{ asset('') }}{{$product->slug}}">{{$product->name}}</a></h6>
											<div class="product_price">{{$product->cost}}<span></span></div>
										</div>
									</div>

								</div>

								@endforeach
								<div class="text-center">
									{{ $all_product->links() }}
								</div>

								<!-- Product Sorting -->

							</div>

							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"> </div>
@endsection
@section('js')
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/categories_custom.js') }}"></script>
<script>
	
	
	$(function()
	{
		$('.slider').on('input change', function(){
			$(this).next($('.slider_label')).html(this.value);
		});
		$('.slider_label').each(function(){
			var value = $(this).prev().attr('value');
			$(this).html(value);
		});  
	})

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//add new product
	// $('#formAddProduct').on('submit', function(event){
	// 	event.preventDefault();
	// 	var thumbnail = $('#thumbnail').get(0).files[0];
	// 	var formData = new FormData();
	// 	formData.append('name', $('#name').val());
	// 	formData.append('brand_id', $('#brand_id option:selected').val());
	// 	formData.append('quantity', $('#quantity').val());
	// 	formData.append('cost', $('#cost').val());
	// 	formData.append('discount', $('#discount').val());
	// 	formData.append('os', $('#os').val());
	// 	formData.append('camera_font', $('#camera_front').val());
	// 	formData.append('camera_rear', $('#camera_rear').val());
	// 	formData.append('ram', $('#ram').val());
	// 	formData.append('cpu_speed', $('#cpu_speed').val());
	// 	formData.append('internal_memory', $('#internal_memory').val());
	// 	formData.append('external_memory_card', $('#external_memory_card').val());
	// 	formData.append('bluetooth', $('#bluetooth').val());
	// 	formData.append('screen_size', $('#screen_size').val());
	// 	formData.append('length', $('#length').val());
	// 	formData.append('width', $('#width').val());
	// 	formData.append('thickness', $('#thickness').val());
	// 	formData.append('weight', $('#weight').val());
	// 	formData.append('battery', $('#battery').val());
	// 	formData.append('thumbnail', thumbnail);
	// 	$.ajax({
	// 		url: '{{ route('admin.product.store') }}',
	// 		type: 'POST',
	// 		data: formData,
	// 		processData: false,
	// 		contentType: false,
	// 		success: function(res){
	// 			$('#modalAddProduct').modal('hide');
	// 			toastr['success']('Add new CellPhone successfully!');
	// 			$('#tableProduct').prepend('<tr id="row-'+res.id+'" role="row" class="odd"><td class="sorting_1">'+res.id+'</td><td><img src="http://dss.me/'+res.thumbnail+'" alt="" height="80px"></td><td>'+res.name+'</td><td>'+res.brand_name+'</td><td>'+res.quantity+'</td><td>'+res.cost+'</td><td>'+res.updated_at+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id="'+res.id+'"></a></td></tr>');
	// 			// console.log(res);
	// 			document.getElementById("formAddProduct").reset();
	// 		},
	// 		error: function(xhr, ajaxOptions, thrownError){
	// 			toastr['error']('Add failed');
	// 		}
	// 	})
	// })

</script>
@endsection