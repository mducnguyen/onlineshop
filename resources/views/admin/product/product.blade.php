@extends('admin.layout')

@section('content')

{{-- Search for ADMIN --}}

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

<div id="ProductList" style="overflow: scroll; height: 1000px; width: 900px;">
	<table class="table table-striped">
		<tr>
			<th style="width: 300px">Name</th>
			<th>Price</th>
			<th>Units</th>
			<th style="width: 150px">Action</th>
		</tr>

		@foreach ($products as $p)

		<tr>
			<td><a href=""><?=$p->name?></a></td>	
			{{-- <td width = "20%" overflow= "hidden">{{$p->description}}</td> --}}
			{{-- <td width = "30%" overflow= "hidden">{{$p->technicalSpec}}</td> --}}
			<td>{{$p->price}}</td>
			<td>{{$p->units}}</td>
			<td>
				{!! Form::open(array('action' => array('Admin\ProductController@edit', $p->productID), 'method' => 'get')) !!}
				<button type="submit" class="btn btn-default">Edit</button>
				{!! Form::close() !!}

				{!! Form::open(array('action' => array('Admin\ProductController@destroy', $p->productID), 'method' => 'delete')) !!}
				<button type="submit" class="btn btn-default">Delete</button>
				{!! Form::close() !!}
			</td>
		</tr>

		@endforeach

	</table>


</div>
{!! link_to_action('Admin\ProductController@create', 'Add Product', null, ['class' => 'btn btn-primary', 'id' => 'addButton'])!!}
@endsection

