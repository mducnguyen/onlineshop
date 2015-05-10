
<head>

</head>
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
