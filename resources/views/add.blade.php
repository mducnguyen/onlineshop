@if(isset($errors))
<ul>
	<?php foreach ($errors->all() as $error) { ?>
		<li><?=$error;?></li>
	<?php } ?>
</ul>
@endif

@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="background: pink">{{ Session::get('message') }}</p>
@endif
<form action="/product/save" method="post">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	Product name:<br>
	<input type="text" name="name">
	<br>
	Description:<br>
	<input type="text" name="description"><br>
	Technical Description:<br>
	<textarea rows="4" cols="40" name="technicalDisc"></textarea>
	<br>
	Price:<br>
	<input type="text" name="price" value="0.0">
	<br>
	<input type="submit" name"add" value="Add Product">
</form>
