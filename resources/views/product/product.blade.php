@extends('app')

@section('search')
	@include('product._search')
@endsection

@section('categoriesNav')
	@include('product._categoriesNav')
@endsection

@section('content')
@include('product._productlist')
@endsection
