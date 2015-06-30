@extends('admin.layout')

@section('content')

    <h2>These products are frequently bought together</h2>
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Group size
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            @foreach(range(2,6) as $i)
                <li role="presentation"><a tabindex="-1" href="{{ action('Admin\AnalyticController@associationAnalyse', ['groupsize' => $i]) }}">{{$i}}</a></li>
            @endforeach
        </ul>
    </div>
    @foreach ($itemsets as $itemset)
        <div id="ProductList" style="overflow: scroll; width: 100%">
            <h3>Support: {{ number_format($itemset->getSupport() * 100, 2) }}%</h3>
            <table class="table table-striped">
                <tr>
                    <th style="width: 50px"></th>
                    <th style="width: 603px">Name</th>
                </tr>

                @foreach ($itemset->getProducts() as $p)

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
                    </tr>

                @endforeach

            </table>


        </div>
    @endforeach

    <h2>Association Rules</h2>

    <table class="table table-striped">
        <tr>
            <th style="width: 45%">IF</th>
            <th style="width: 45%">THEN</th>
            <th style="width: 10%">Confidence</th>
        </tr>

        @foreach ($rules as $rule)
            <tr>
                <td>
                    <ul>
                        @foreach ($rule->getLSet()->getProducts() as $p)
                            <li>{{ $p->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach ($rule->getRSet()->getProducts() as $p)
                            <li>{{ $p->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ number_format($rule->getConfidence() * 100, 2) }} %</td>
            </tr>
        @endforeach

    </table>

@endsection
