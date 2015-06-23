@extends('admin.layout')

@section('content')

    @foreach ($product_sets as $products)
        <div id="ProductList" style="overflow: scroll;">
            <h3>These products are frequently bought together (Support >10%)</h3>
            <table class="table table-striped">
                <tr>
                    <th style="width: 50px"></th>
                    <th style="width: 603px">Name</th>
                    <th>Price</th>
                </tr>

                @foreach ($products as $p)

                    <tr>
                        <td>
                            <div class="image">
                                @if (!$p->images->isEmpty())
                                    <?php $image = $p->images->first(); ?>
                                    {!! HTML::image("img/$image->filename", $p->name, ['width' => 50, 'height' => 50]) !!}
                                @endif
                            </div>
                        </td>
                        <td><a href=""><?=$p->name?></a></td>
                        <td>{{$p->price}}</td>
                    </tr>

                @endforeach

            </table>


        </div>
    @endforeach

@endsection
