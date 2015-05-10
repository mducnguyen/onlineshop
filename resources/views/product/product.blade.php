<form action="product/search" method="get">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	search: <input type="text" name="searchTerm" size="30" placeholder="search for some Product">	
	<button type="submit">Search</button>
</form>
@if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="background: pink">{{ Session::get('message') }}</p>
@endif

<table border=1>
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th>Technical Spec</th>
		<th>Price</th>
		<th>Action</th>
	</tr>

<?php foreach ($products as $p) { ?>

	<tr>
		<td><a href=""><?=$p->name?></a></td>	
		<td><?=$p->description?></td>
		<td><?=$p->technicalDisc?></td>
		<td><?=$p->price?></td>
		<td><a href="product/<?=$p->productsID?>/edit">Edit</a> <a href="product/<?=$p->productsID?>/delete">Delete</a></td>
	</tr>


<?php } ?>
</table>
<a href="product/add">
<br>
<button>Add Product</button>
</a>
