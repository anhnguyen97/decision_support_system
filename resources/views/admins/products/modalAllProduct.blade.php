{{-- MODAL ADD PRODUCT --}}
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
										@foreach ($allBrandSelectOption as $brand)
										<option value="{{$brand['id']}}">{!!$brand['name']!!}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thumbnail</label>
									<input type="file" class="form-control" id="thumbnail" required="">
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
									<input type="number" class="form-control" id="discount" min="0" max="100" step="0.1">
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
									<input type="number" class="form-control" id="camera_front" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Camera rear</label>
									<input type="number" class="form-control" id="camera_rear" min="0" step="0.1">
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
									<input type="number" class="form-control" id="cpu_speed" min="0" max="50" step="0.1">
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
									<input type="number" class="form-control" id="bluetooth" min="0" step="0.1">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">Screen size</label>
									<input type="number" class="form-control" id="screen_size" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Length</label>
									<input type="number" class="form-control" id="length" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Width</label>
									<input type="number" class="form-control" id="width" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thickness</label>
									<input type="number" class="form-control" id="thickness" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Weight</label>
									<input type="number" class="form-control" id="weight" min="0" step="0.1">
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
<!--/.end Modal add Product -->

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog" style="width: 900px">
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
					<table width="100%" class="tblCommon">
						<tr>
							<td >
								<div class="form-group">
									<label for="">Product's name</label>
									<input type="text" class="form-control" id="edit-name" placeholder="Input product's name">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Brand</label>
									<select name="brand" class="form-control" id="brand_id">
										@foreach ($allBrandSelectOption as $brand)
										<option value="{{$brand['id']}}">{!!$brand['name']!!}</option>
										@endforeach
									</select>
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thumbnail</label>
									<input type="file" class="form-control" id="edit-thumbnail">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">Quantity</label>
									<input type="number" class="form-control" id="edit-quantity" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Cost</label>
									<input type="number" class="form-control" id="edit-cost" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Discount</label>
									<input type="number" class="form-control" id="edit-discount" min="0" max="100" step="0.1">
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
									<input type="text" class="form-control" id="edit-os" maxlength="50">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Camera front</label>
									<input type="number" class="form-control" id="edit-camera_front" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Camera rear</label>
									<input type="number" class="form-control" id="edit-camera_rear" min="0">
								</div>
							</td>											
							<td>
								<div class="form-group">
									<label for="">Battery</label>
									<input type="number" class="form-control" id="edit-battery" min="0">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">CPU speed</label>
									<input type="number" class="form-control" id="edit-cpu_speed" min="0" max="50" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Ram</label>
									<input type="number" class="form-control" id="edit-ram" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Internal memory</label>
									<input type="number" class="form-control" id="edit-internal_memory" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">External memory card</label>
									<input type="number" class="form-control" id="edit-external_memory_card" min="0">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Bluetooth</label>
									<input type="number" class="form-control" id="edit-bluetooth" min="0" step="0.1">
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<label for="">Screen size</label>
									<input type="number" class="form-control" id="edit-screen_size" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Length</label>
									<input type="number" class="form-control" id="edit-length" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Width</label>
									<input type="number" class="form-control" id="edit-width" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Thickness</label>
									<input type="number" class="form-control" id="edit-thickness" min="0" step="0.1">
								</div>
							</td>
							<td>
								<div class="form-group">
									<label for="">Weight</label>
									<input type="number" class="form-control" id="edit-weight" min="0" step="0.1">
								</div>
							</td>
						</tr>
					</table>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- /.end Modal EDIT --}}

<div class="modal fade" id="modalShow">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thông số kỹ thuật chi tiết <span id="product_name"></span></h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<tr>
						<td colspan="2" class="text-center">
							<img src="" class="img-responsive text-center align-items-lg-center" id="show-thumbnail" alt="Image" width="300px">
						</td>
					</tr>
					<tr>
						<td colspan="2" rowspan="" headers=""></td>
					</tr>
					<tr>
						<td class="field">Hệ điều hành:</td>
						<td><div id="show-os"></div></td>
					</tr>
					<tr>
						<td class="field">Camera sau:</td>
						<td><div id="show-camera_font"></div></td>
					</tr>
					<tr>
						<td class="field">Camera trước:</td>
						<td><div id="show-camera_rear"></div></td>
					</tr>
					<tr>
						<td class="field">CPU:</td>
						<td><div id="show-cpu_speed"></div></td>
					</tr>
					<tr>
						<td class="field">RAM: </td>
						<td><div id="show-ram"></div></td>
					</tr>
					<tr>
						<td class="field">Bộ nhớ trong: </td>
						<td><div id="show-internal_memory"></div></td>
					</tr>
					<tr>
						<td class="field">Thẻ nhớ: </td>
						<td><div id="show-external_memory_card"></div></td>
					</tr>
					<tr>
						<td class="field">Bluetooth: </td>
						<td><div id="show-bluetooth"></div></td>
					</tr>
					<tr>
						<td class="field">Màn hình: </td>
						<td><div id="show-screen_size"></div></td>
					</tr>
					<tr>
						<td class="field">Kích thước: </td>
						<td><div id="show-size"></div></td>
					</tr>
					<tr>
						<td class="field">Trọng lượng: </td>
						<td><div id="show-weight"></div></td>
					</tr>
					<tr>
						<td class="field">Dung lượng pin: </td>
						<td><div id="show-battery"></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
