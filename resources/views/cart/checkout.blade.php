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
            </tr>

            @foreach ($basket_items as $b)
                <tr>
                    <td>{!! HTML::image($b['image'], '', ['width' => 100, 'height' => 100]) !!}</td>
                    <td>{{ $b['name'] }}</td>
                    <td>{{ $b['units'] }}</td>
                    <td>{{  number_format($b['total'], 2, ',', '.') }} &euro;</td>
                </tr>
            @endforeach
        </table>

        <div class="row">
            <div class="col-md-3">
                <h3>Delivery address</h3>
                <table>
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $user->street }}</td>
                    </tr>
                    <tr>
                        <td>{{ $user->ZIPCode }}, {{ $user->city }}</td>
                    </tr>
                    <tr>
                        <td> Germany </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <h3>Billing address</h3>
                <table>
                    <tr>
                        <td><strong>{{ $user->name }}</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $user->street }}</td>
                    </tr>
                    <tr>
                        <td>{{ $user->ZIPCode }}, {{ $user->city }}</td>
                    </tr>
                    <tr>
                        <td> Germany </td>
                    </tr>
                </table>
            </div>
        </div>


        {!! Form::open(array('action' => array('CartController@order'), 'method' => 'post')) !!}
        <button type="submit" class="btn btn-primary" style="float: right">
          <span class="glyphicon glyphicon-lock"></span>
          Buy
        </button>
        {!! Form::close() !!}
        <div class="clear"></div>
    @endif
@endsection
