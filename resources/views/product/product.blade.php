@extends('app')

@section('content')
{!! Form::open(['action' => array('ProductController@search'), 'method' => 'get', 'id' => 'SearchForm']) !!}
  {!! Form::label('searchTerm', 'Search: ')!!}
  {!! Form::text('searchTerm', null, ['class' => 'form-control'])!!}
  {!! Form::submit('Search', ['class' => 'btn btn-primary form-control'])!!}
{!! Form::close() !!}

<div class="clear"></div>

<div class="row" id="ProductList">
  @foreach ($products as $product)
  <a href="{{ action('ProductController@show', [$product->productID]) }}">
    <div class="col-xs-3 product">
    	<div class="image">
    		@if (!$product->images->isEmpty())
    		<?php $image = $product->images->first(); ?>
    		{!! HTML::image("img/$image->image") !!}
    		@endif
    	</div>
      
      <div class="product_info">
        <div class="title">
          {{ $product->name }}
        </div>
        <div class="price">
          {{ number_format($product->price, 2, ',', '.') }} &euro;
        </div>
      </div>
    </div>
  </a>
  @endforeach
</div>

@endsection
