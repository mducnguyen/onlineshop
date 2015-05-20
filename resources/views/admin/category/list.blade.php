@extends('admin.layout')

@section('content')

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped" id="CategoryList">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Action</th>
	</tr>

	@foreach ($categories as $c)

	<tr>
		<td><a href="#">{{ $c->name }}</a></td>	
		<td>{{ $c->description }}</td>
    <td>
      {!! Form::open(array('action' => array('Admin\CategoryController@edit', $c->id), 'method' => 'get')) !!}
        <button type="submit" class="btn btn-default">Edit</button>
      {!! Form::close() !!}

      {!! Form::open(array('action' => array('Admin\CategoryController@destroy', $c->id), 'method' => 'delete')) !!}
        <button type="submit" class="btn btn-default">Delete</button>
      {!! Form::close() !!}
    </td>
	</tr>

	@endforeach

</table>

{!! link_to_action('Admin\CategoryController@create', 'Add Category', null, ['class' => 'btn btn-primary'])!!}
@endsection

