@extends('app')

@section('content')
@include('product._search')

@if (empty($products))
  @include('product._noproduct')
@else
  @include('product._productlist')
@endif

@endsection
