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
  </div>
</div>
