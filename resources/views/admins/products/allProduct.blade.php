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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<style>
#formAddProduct .tblCommon td{
	width:30%;
	padding: 5px 10px 5px 0px;
}
#formAddProduct .tblDetail td{
	width:20%;
	padding: 5px 10px 5px 0px;
}

</style>
@endsection
@section('function')
Quản lý sản phẩm
@endsection
@section('content')
{{-- expr --}}
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<div class="box-header">
					<h3>List products<button data-toggle="modal" href='#modalAddProduct' style="float: right;" class="btn-primary btn fa fa-mobile"> +</button></h3>
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<table id="tableProduct" class="table table-bordered table-striped text-center">
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

				{{-- MODAL EDIT --}}
				<div class="modal fade" id="modalEdit">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Edit Product</h4>
							</div>
							<div class="modal-body">
								<form action="" method="POST" role="form" id="formUpdateProduct">
									@method('PUT')
									@csrf

									<input type="text" class="form-control hidden" id="edit-id" name="edit-id">
									<div class="form-group">
										<label for="">Product's name</label>
										<input type="text" class="form-control" id="edit-name">
									</div>
									<div class="form-group">
										<label for="">Desciption</label>
										<textarea class="form-control" id="edit-description" ></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

<div class="modal fade" id="modalAddProduct">
	<div class="modal-dialog" style="width: 900px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add new Product</h4>
			</div>
			<div class="modal-body container-fluid">
				<form action="" method="POST" role="form" id="formAddProduct" class="container-fluid">
					@csrf
					<table width="100%" class="tblCommon">
						<tr>
							<td >
								<div class="form-group">
									<label for="">Product's name</label>
									<input type="text" class="form-control" id="name" placeholder="Input product's name">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Brand</label>
									<select name="brand" class="form-control" id="brand_id">
										@foreach ($allBrand as $brand)
										<option value="{{$brand['id']}}">{!!$brand['name']!!}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thumbnail</label>
									<input type="file" class="form-control" id="thumbnail">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">Quantity</label>
									<input type="number" class="form-control" id="quantity" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Cost</label>
									<input type="number" class="form-control" id="cost" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Discount</label>
									<input type="number" class="form-control" id="discount" min="0" max="100">
								</div>
							</td>
						</tr>
					</table>
					<h4 class="text-primary"><u>Thông số kĩ thuật</u></h4>
					<table width="100%" class="tblDetail">
						<tr>
							<td>
								<div class="form-group">
									<label for="">OS</label>
									<input type="text" class="form-control" id="os" maxlength="50">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Camera front</label>
									<input type="number" class="form-control" id="camera_front" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Camera rear</label>
									<input type="number" class="form-control" id="camera_rear" min="0">
								</div>
							</td>											
							<td>
								<div class="form-group">
									<label for="">Battery</label>
									<input type="number" class="form-control" id="battery" min="0">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">CPU speed</label>
									<input type="number" class="form-control" id="cpu_speed" min="0" max="50">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Ram</label>
									<input type="number" class="form-control" id="ram" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Internal memory</label>
									<input type="number" class="form-control" id="internal_memory" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">External memory card</label>
									<input type="number" class="form-control" id="external_memory_card" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Bluetooth</label>
									<input type="number" class="form-control" id="bluetooth" min="0">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">Screen size</label>
									<input type="number" class="form-control" id="screen_size" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Length</label>
									<input type="number" class="form-control" id="length" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Width</label>
									<input type="number" class="form-control" id="width" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thickness</label>
									<input type="number" class="form-control" id="thickness" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Weight</label>
									<input type="number" class="form-control" id="weight" min="0">
								</div>
							</td>
						</tr>
					</table>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

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
		$('#tableProduct').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.product.getData') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'thumbnail', name: 'thumbnail'},
			{ data: 'name', name: 'name' },
			{ data: 'brand', name: 'brand'},
			{ data: 'quantity', name: 'quantity' },
			{ data: 'cost', name: 'cost' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	$('#formAddProduct').on('submit', function(event){
		event.preventDefault();
		var formData = new FormData();
		formData.append('name', $('#name').val());
		formData.append('brand_id', $('#brand_id option:selected').val());
		formData.append('quantity', $('#quantity').val());
		formData.append('cost', $('#cost').val());
		formData.append('discount', $('#discount').val());
		formData.append('os', $('#os').val());
		formData.append('camera_front', $('#camera_front').val());
		formData.append('camera_rear', $('#camera_rear').val());
		formData.append('ram', $('#ram').val());
		formData.append('cpu_speed', $('#cpu_speed').val());
		formData.append('internal_memory', $('#internal_memory').val());
		formData.append('external_memory_card', $('#external_memory_card').val());
		formData.append('bluetooth', $('#bluetooth').val());
		formData.append('screen_size', $('#screen_size').val());
		formData.append('length', $('#length').val());
		formData.append('width', $('#width').val());
		formData.append('thickness', $('#thickness').val());
		formData.append('weight', $('#weight').val());
		formData.append('battery', $('#battery').val());
		formData.append('thumbnail', $('#thumbnail').val());
		$.ajax({
			url: '{{ route('admin.product.store') }}',
			type: 'POST',
			data: formData,
			success: function(res){
				$('#modalAddProduct').modal('hide');
				toastr['success']('Add new CellPhone successfully!');
				$('#tableProduct').prepend();

			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show Product detail to update
	$('#tableProduct').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}admin/products/edit/'+id,
			type: 'GET',
			success: function(res){
				$('#modalEdit').modal('show');
				$('#edit-name').attr('value',res.name);
				$('textarea#edit-description').val(res.description);
				$('#edit-id').attr('value',res.id);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display Product to edit');
			}
		})
	});

	// update Product
	$('#formUpdateProduct').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/products/update/'+id,
			type: 'PUT',
			data: {
				name: $('#edit-name').val(),
				description: $('#edit-description').val(),
			},
			success: function(res){
				$('#modalEdit').modal('hide');
				var row = document.getElementById('row-'+res.id);
				// alert('row');
				row.remove();
				toastr['success']('Update Product: '+res.name+' successfully!');
				$('#tableProduct').prepend('<tr id="'+res.id+'"><td width="5%" class="text-center">'+res.id+'</td><td class="text-left">'+res.name+'</td><td>'+res.description+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td class="text-center" width="15%" ><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res.id+'></a></td></tr>');

				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	})

</script>
@endsection