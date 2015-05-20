<div id="Navbar">

  <ul>
    @foreach($categories as $category)
      <li>
        {!! link_to_action('CategoryController@show', $category->name, [$category->id]) !!}
      </li>  
    @endforeach
  </ul>

</div>
