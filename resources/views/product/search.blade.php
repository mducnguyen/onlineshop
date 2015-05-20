@extends('app')


@section('search')
	@include('product._search')
@endsection

@section('categoriesNav')
	@include('product._categoriesNav')
@endsection


@section('content')
@if ($products->isEmpty())
  @include('product._noproduct')
@else
  @include('product._productlist')
@endif

@endsection
