<div class="row" id="ProductList">
  @foreach ($products as $product)
  <a href="{{ action('ProductController@show', [$product->productID]) }}">
    <div class="col-xs-3 product">
    	<div class="image">
    		@if (!$product->images->isEmpty())
    		<?php $image = $product->images->first(); ?>
    		{!! HTML::image("img/$image->filename") !!}
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
