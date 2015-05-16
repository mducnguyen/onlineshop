{!! Form::open(['action' => array('ProductController@search'), 'method' => 'get', 'id' => 'SearchForm']) !!}
  {!! Form::text('searchTerm', null, ['class' => 'form-control', 'placeholder' => 'Search for products'])!!}
  {!! Form::submit('Search', ['class' => 'btn btn-primary form-control'])!!}
{!! Form::close() !!}

<div class="clear"></div>
