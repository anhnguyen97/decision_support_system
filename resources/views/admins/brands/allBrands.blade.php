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
					<h3 {{-- class="box-title" --}}>List brands<a data-toggle="modal" href='#modalAddBrand' class="fa fa-plus-square" style="float: right; color: green"> new brand</a></h3>

					{{-- // modal add new brand --}}
					// my favourite brand: Apple :))
					<div class="modal fade" id="modalAddBrand">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Add new brand</h4>
								</div>
								<div class="modal-body">
									<form action="{{ asset('admin/brands/store') }}" method="POST" role="form" id="formAddBrand">
										@csrf

										<div class="form-group">
											<label for="">Brand's name</label>
											<input type="text" class="form-control" id="name" placeholder="Input brand's name">
										</div>
										<div class="form-group">
											<label for="">Desciption</label>
											<textarea class="form-control" id="description" placeholder="Input brand's description"></textarea>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
					<!--/. end Modal add new brand -->	
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<table id="tableBrand" class="table table-bordered table-striped text-center">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th class="text-center" >Name</th>
								<th class="text-center" >Description</th>
								<th class="text-center" >Created at</th>
								<th class="text-center" >Lastest updated</th>
								<th class="text-center" width="15%">Action</th>
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

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Brand</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="formUpdateBrand">
					@method('PUT')
					@csrf

					<input type="text" class="form-control hidden" id="edit-id" name="edit-id">
					<div class="form-group">
						<label for="">Brand's name</label>
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
<!--/. end Modal EDIT -->

<!--MODAL LIST PRODUCT Group by Brand -->
<div class="modal fade" id="modalListProduct">
	<div class="modal-dialog" style="width: 1200px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">List product group by Brand: <span id="filter_brand_id"></span> </h4>
			</div>
			<div class="modal-body">
				<table id="tableListProduct" class="table table-bordered table-striped text-center tableListProduct">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--end modal List product -->
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
		$('#tableBrand').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.brand.getData') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'desciption'},
			{ data: 'created_at', name: 'created_at' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	$('#formAddBrand').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: '{{ route('admin.brand.store') }}',
			type: 'POST',
			data: {
				name: $('#name').val(),
				description: $('#description').val(),
			},
			success: function(res){
				$('#modalAddBrand').modal('hide');
				toastr['success']('Add new Brand successfully!');
				$('#tableBrand').prepend('<tr id="row-'+res.id+'"><td width="5%" class="text-center">'+res.id+'</td><td class="text-left">'+res.name+'</td><td>'+res.description+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td class="text-center" width="15%" ><a title="Detail" href="http://dss.me/admin/brands/"'+res.slug+'" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res.id+'></a></td></tr>');
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show brand detail to update
	$('#tableBrand').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}admin/brands/edit/'+id,
			type: 'GET',
			success: function(res){
				$('#modalEdit').modal('show');
				$('#edit-name').attr('value',res.name);
				$('textarea#edit-description').val(res.description);
				$('#edit-id').attr('value',res.id);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display brand to edit');
			}
		})
	});

	// update brand
	$('#formUpdateBrand').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/brands/update/'+id,
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
				toastr['success']('Update Brand: '+res.name+' successfully!');
				$('#tableBrand').prepend('<tr id="'+res.id+'"><td width="5%" class="text-center">'+res.id+'</td><td class="text-left">'+res.name+'</td><td>'+res.description+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td class="text-center" width="15%" ><a title="Detail" href="http://dss.me/admin/brands/"'+res.slug+'" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res.id+'></a></td></tr>');				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	});

	//delete brand
	$('#tableBrand').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Brand!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}admin/brands/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						console.log(res);
						if (res == 'existProduct') {
							swal({
								title:"Can't delete brand",
								text: "You must delete product before deleting brand.",
								icon: "warning",
							});						
						} 
						if(res == "success") {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "The brand has been deleted!",
								icon: "success",
							});
						}						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Delete this brand failed!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "The brand is safety!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>
@endsection