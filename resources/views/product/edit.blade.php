
<head>

</head>
<form action="/product/<?=$product->productsID?>/update" method="post">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	Product name:<br>
	<input type="text" name="name" value="<?=$product->name?>">
	<br>
	Description:<br>
	<input type="text" name="description" value="<?=$product->description?>"><br>
	Technical Description:<br>
	<textarea rows="4" cols="40" name="technicalDisc" ><?=$product->technicalDisc?></textarea>
	<br>
	Price:<br>
	<input type="text" name="price" value="<?=$product->price?>">
	<br>
	<input type="submit" name"add" value="AN CUT">
</form>
