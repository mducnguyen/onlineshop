@extends('admin.layout')

@section('content')


    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Choose Product
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            @foreach($products as $product)
                @foreach($product as $p)
                <li role="presentation"><a tabindex="-1" href="{{ action('Admin\AnalyticController@partsListOf', ['id' => $p->productID]) }}">{{ $p->name }}</a></li>
                @endforeach
            @endforeach
        </ul>
    </div>



    @if(isset($partsList))
    <div id="ProductList">
        <table class="table table-striped">
            <tr>
                <th style="width: 600px">Name</th>
                <th>Level</th>
                <th style="width: 150px">Units</th>
            </tr>

            @foreach ($partsList as $lists)
                @foreach($lists as $l )
            <tr>
                <td><a href="">{{$l['name']}}</a></td>
                <td>{{$l['level']}}</td>
                <td>{{$l['units']}}</td>
            </tr>
                 @endforeach
            @endforeach

        </table>
    </div>


@endif
@endsection
