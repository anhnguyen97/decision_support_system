@extends('admins.layouts.master')
@section('css')
@include('admins.layouts.css')
@endsection
@section('function')
Topsis function
@endsection
@section('content')
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
	<ol>
	    <li style="font-size: 25pt"><a href="{{ route('entropy') }}" >Cập nhật trọng số entropy</a></li>
	    <li style="font-size: 25pt"><a href="{{ route('normalizateProduct') }}">Chuẩn hóa ma trận quyết định</a></li>
	</ol>
	<!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('js')
@include('admins.layouts.js')
@endsection