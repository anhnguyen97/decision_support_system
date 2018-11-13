@extends('admins.layouts.master')
@section('css')

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admins/dist/css/AdminLTE.min.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('admins/dist/css/skins/_all-skins.min.css') }}">

<link rel="stylesheet" href="{{ asset('admins/dist/css/admin.tablemodal.css') }}">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection
@section('function')
Quản lý thương hiệu
@endsection
@section('content')
{{-- expr --}}
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<a href="{{ asset('admin/brand/') }}" title=""></a>
				<div class="box-header">
					<input type="hidden" name="brand_slug_view" value="{!!$brand_slug!!}" id="brand_slug_view">
					<h3 {{-- class="box-title" --}}>Brand: 
						<span id="brand_view">{{$brand_slug}}</span>
						<button data-toggle="modal" href='#modalAddProduct' style="float: right;" class="btn-primary btn fa fa-mobile"> +</button>
					</h3>
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<table id="tablePByB" class="table table-bordered table-striped text-center tableProduct">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th>Thumbnail</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Quantity</th>
								<th>Cost</th>
								<th>Lastest updated</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

@endsection
@include('admins.products.modalAllProduct')
@section('js')
{{-- expr --}}
<!-- jQuery 3 -->
<script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
{{-- <script src="{{ asset('admins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> --}}
<!-- FastClick -->
{{-- <script src="{{ asset('admins/bower_components/fastclick/lib/fastclick.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('admins/dist/js/adminlte.min.js') }}"></script>
<!-- page script -->
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function () {
		var brand_slug =  $('#brand_slug_view').val();
		$('#tablePByB').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: '{{ asset('') }}admin/brands/show/'+brand_slug,
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'thumbnail', name: 'thumbnail', render: function(data, type, full, meta){
				return '<img src=\"http://dss.me/'+data+'" alt="" height="80px">'}
			},
			{ data: 'name', name: 'name' },
			{ data: 'brand', name: 'brand'},
			{ data: 'quantity', name: 'quantity' },
			{ data: 'cost', name: 'cost' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

</script>
@include('admins.products.ajaxAllProduct')
@endsection