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
			destroy: true,
			ajax: '{!! route('admin.product.getData') !!}',
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

	//add new product
	$('#formAddProduct').on('submit', function(event){
		event.preventDefault();
		var thumbnail = $('#thumbnail').get(0).files[0];
		var formData = new FormData();
		formData.append('name', $('#name').val());
		formData.append('brand_id', $('#brand_id option:selected').val());
		formData.append('quantity', $('#quantity').val());
		formData.append('cost', $('#cost').val());
		formData.append('discount', $('#discount').val());
		formData.append('os', $('#os').val());
		formData.append('camera_font', $('#camera_front').val());
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
		formData.append('thumbnail', thumbnail);
		$.ajax({
			url: '{{ route('admin.product.store') }}',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(res){
				$('#modalAddProduct').modal('hide');
				toastr['success']('Add new CellPhone successfully!');
				$('#tableProduct').prepend('<tr id="row-'+res.id+'" role="row" class="odd"><td class="sorting_1">'+res.id+'</td><td><img src="http://dss.me/'+res.thumbnail+'" alt="" height="80px"></td><td>'+res.name+'</td><td>'+res.brand_name+'</td><td>'+res.quantity+'</td><td>'+res.cost+'</td><td>'+res.updated_at+'</td><td><a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id="'+res.id+'"></a></td></tr>');
				// console.log(res);
				document.getElementById("formAddProduct").reset();
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show Product detail to update
	$('.tableProduct').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}admin/products/edit/'+id,
			type: 'GET',
			success: function(res){
				console.log(res);
				$('#modalEdit').modal('show');
				$('#edit-name').attr('value',res.name);
				$('#edit-quantity').attr('value',res.quantity);
				$('#edit-cost').attr('value',res.cost);
				$('#edit-discount').attr('value',res.discount);
				$('#edit-os').attr('value',res.os);
				$('#edit-camera_front').attr('value',res.detail.camera_font);
				$('#edit-camera_rear').attr('value',res.detail.camera_rear);
				$('#edit-ram').attr('value',res.detail.ram);
				$('#edit-cpu_speed').attr('value',res.detail.cpu_speed);
				$('#edit-internal_memory').attr('value',res.detail.internal_memory);
				$('#edit-external_memory_card').attr('value',res.detail.external_memory_card);
				$('#edit-bluetooth').attr('value',res.detail.bluetooth);
				$('#edit-screen_size').attr('value',res.detail.screen_size);
				$('#edit-length').attr('value',res.detail.length);
				$('#edit-width').attr('value',res.detail.width);
				$('#edit-thickness').attr('value',res.detail.thickness);
				$('#edit-weight').attr('value',res.detail.weight);
				$('#edit-battery').attr('value',res.detail.battery);
				$('#brand_id option[value="'+res.brand_id+'"]').prop('selected', true);
				// $('thumbnail', thumbnail);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display Product to edit');
			}
		})
	});

	//show Product detail
	$('.tableProduct').on('click', '.btnShow', function(event){
		event.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: '{{ asset('') }}admin/products/show/'+id,
			type: 'GET',
			success: function(res){
				$('#modalShow').modal('show');
				$('#product_name').text(res.name);
				$('#show-os').text(res.os);
				$('#show-camera_font').text(res.detail.camera_font + "MP");
				$('#show-camera_rear').text(res.detail.camera_rear+" MP");
				$('#show-cpu_speed').text(res.detail.cpu_speed+ " GHz");
				$('#show-ram').text(res.detail.ram+ "G");
				$('#show-internal_memory').text(res.detail.internal_memory+ "G");
				$('#show-external_memory_card').text(res.detail.external_memory_card+ "G");
				$('#show-bluetooth').text("v."+res.detail.bluetooth);
				$('#show-screen_size').text(res.detail.screen_size+" \"");
				$('#show-weight').text(res.detail.weight+" g");
				$('#show-battery').text(res.detail.battery+" mAh");
				$('#show-size').text("Dài "+res.detail.length+" mm"+" - Ngang "+res.detail.width+" mm"+" - Dày "+res.detail.thickness+ " mm");
				console.log(res.thumbnail);
				$('#show-thumbnail').attr('src', "http://dss.me/"+res.thumbnail);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Load Product failed');
			}
		})
	})

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

	//delete product
	$('.tableProduct').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Product!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}admin/products/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						var row = document.getElementById('row-'+id);
						row.remove();
						swal({
							title: "The product has been deleted!",
							icon: "success",
						});					
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Delete this product failed!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "The product is safety!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>