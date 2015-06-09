@extends('app')

@section('content')
    @if(empty($basket_items))
        <h3>Your shopping cart is empty.</h3>
    @else
        <table class="table table-striped">
            <tr>
                <th style="width: 100px"></th>
                <th >Name</th>
                <th style="width: 120px">Units</th>
                <th style="width: 150px">Total</th>
                <th style="width: 20px"></th>
            </tr>

            @foreach ($basket_items as $b)
                <tr>
                    <td>{!! HTML::image($b['image'], '', ['width' => 100, 'height' => 100]) !!}</td>
                    <td>{{ $b['name'] }}</td>
                    <td>
                        {!! Form::open(array('action' => array('CartController@update', $b['itemID']), 'method' => 'put')) !!}
                        <input type="text" name="units" size="3" id="" value="{{ $b['units'] }}" />
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
                        {!! Form::close() !!}

                    </td>
                    <td>{{  number_format($b['total'], 2, ',', '.') }} &euro;</td>
                    <td>
                        {!! Form::open(array('action' => array('CartController@destroy', $b['itemID']), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
        @endforeach
            </table>
        <a href="{{ action('CartController@checkout') }}" class="btn btn-primary" style="float: right">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Checkout
        </a>
        <div class="clear"></div>
    @endif
@endsection
