<div class="row">
  
  <div class='col-xs-6'>
    
    <div class="form-group">
      {!! Form::label('name', 'Product name: ') !!}
      {!! Form::text('name', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::label('description', 'Description: ') !!}
      {!! Form::textarea('description', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::label('technicalSpec', ' Technical specifiaction: ') !!}
      {!! Form::textarea('technicalSpec', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::label('price', 'Price: ') !!}
      {!! Form::text('price', null , [ 'class' => 'form-control', 'placeholder' => 'in EUR'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::label('units', 'Units: ') !!}
      {!! Form::text('units', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::submit('Save Product', [ 'class' => 'btn btn-primary form-control'] ) !!}
    </div>  
 
  </div>
  
  <div class="col-xs-6">
    
    <div class="form-group" id="CategorySelection">
      {!! Form::label('categories', 'Categories: ') !!}
      {!! Form::select('categories[]', $all_cats, $selected_cats, ['multiple' => true, 'class' => 'form-control']) !!}
    </div>  

    <div class="form-group" id="SubpartSelection">
      {!! Form::label('subparts', 'Components: ') !!}
      {!! Form::select('subparts[]', $all_subparts, $selected_subparts, ['multiple' => true, 'class' => 'form-control']) !!}
    </div>  

    <div class="form-group" id="imageSelection">
      {!! Form::label('image', 'Images: ') !!}
      {!! Form::file('image') !!}

    </div>
    <div id="uploadedImages">
      @foreach ($images as $image)
        {!! HTML::image("img/".$image->filename) !!}

        {!! link_to_action('Admin\ImageController@destroy', '&#10008;', [$image->id], ['class' => "btn btn-default"]) !!}

      @endforeach 
    </div>


     {{-- <div class="form-group" id="uploadedImage">
      {!! Form::label('uploadedImage', 'Uploaded Image: ') !!}
      {!! Form::select('uploadedImage[]', $all_subparts, $selected_subparts, ['multiple' => true, 'class' => 'form-control']) !!}
    </div>   --}}



  </div>

</div>
