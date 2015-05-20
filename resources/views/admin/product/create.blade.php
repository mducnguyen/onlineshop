@extends('admin.layout')

@section('searchBar')
	@include('product._search')
@stop
@section('content')
	<h3>Add a new product</h3>

	<hr>
	@if($errors->any())
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)		
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	{!! Form::open(['action' => ['Admin\ProductController@store'], 'method' => 'post', 'files'=>true])!!}
    	@include('admin.product._form')
	{!! Form::close()!!}
@stop
