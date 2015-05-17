@extends('app')

@section('content')

{{-- Search for ADMIN --}}

@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="background: pink">{{ Session::get('message') }}</p>
@endif

<table class="table table-striped">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Technical Spec</th>
		<th>Price</th>
		<th>Units</th>
		<th>Action</th>
	</tr>

	@foreach ($products as $p)

	<tr>
		<td><a href=""><?=$p->name?></a></td>	
		<td>{{$p->description}}</td>
		<td>{{$p->technicalSpec}}</td>
		<td>{{$p->price}}</td>
		<td>{{$p->units}}</td>
		<td>{!! link_to_action('Admin\ProductController@edit', 'Edit', [$p->productID]) !!} {!! link_to_action('Admin\ProductController@delete', 'Delete', [$p->productID]) !!}</td>
	</tr>

	@endforeach

</table>

{!! link_to_action('Admin\ProductController@create', 'Add Product', null, ['class' => 'btn btn-primary'])!!}
@endsection

