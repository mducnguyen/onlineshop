
@extends('admin.layout')

@section('content')
	<h3>Edit category</h3>

	<hr>
	@if($errors->any())
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)		
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

  {!! Form::model($category, ['action' => ['Admin\CategoryController@update', $category->id], 'method' => 'put']) !!}
    @include('admin.category._form')
  {!! Form::close()!!}
@stop
