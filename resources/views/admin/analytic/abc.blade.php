@extends('admin.layout')

@section('content')

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <table class="table table-striped" id="CategoryList">
        <tr>
            <th>Name</th>
            <th>Value</th>
            <th>ABC</th>
        </tr>

        @foreach($productsA as $id => $p)
           <tr>
               <td>{{ $p['name'] }}</td>
               <td>{{ $p['abc'] }}</td>
               <td> A </td>
           </tr>
        @endforeach

        <tr>
          <td>###########</td>
          <td>###########</td>
            <td> # </td>
        </tr>

        @foreach($productsB as $id => $p)
           <tr>
               <td>{{ $p['name'] }}</td>
               <td>{{ $p['abc'] }}</td>
               <td> B </td>
           </tr>
        @endforeach

        <tr>
          <td>###########</td>
          <td>###########</td
          td> # </td>
        </tr>

        @foreach($productsC as $id => $p)
           <tr>
               <td>{{ $p['name'] }}</td>
               <td>{{ $p['abc'] }}</td>
               <td> C </td>
           </tr>
        @endforeach
    </table>
@endsection
