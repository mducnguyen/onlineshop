<div class="row">
  
  <div class='col-xs-6'>
    
    <div class="form-group">
      {!! Form::label('name', 'Category name: ') !!}
      {!! Form::text('name', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::label('description', 'Description: ') !!}
      {!! Form::textarea('description', null , [ 'class' => 'form-control'] ) !!}
    </div>  

    <div class="form-group">
      {!! Form::submit('Save Category', [ 'class' => 'btn btn-primary form-control'] ) !!}
    </div>  
 
  </div>
  
  <div class="col-xs-6">
  </div>
</div>
