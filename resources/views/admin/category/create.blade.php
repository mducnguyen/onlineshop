@extends('admin.layout')

@section('content')
	<h3>Add a new category</h3>

	<hr>
	@if($errors->any())
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)		
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	{!! Form::open(['action' => 'Admin\CategoryController@store', 'method' => 'post'])!!}
    @include('admin.category._form')
	{!! Form::close()!!}
@stop
