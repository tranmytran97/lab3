<?php require_once("Entities/product.class.php"); 
		require_once("Entities/category.class.php");
?>
<?php 
	include_once("header.php");
	if(!isset($_GET['cateid'])){
		$prods=Product::list_product();
	}
	else{
		$cateid=$_GET["cateid"];
		$prods=Product::list_product_by_cateid($cateid);

	}
	$cates = Category::list_category();
		

?>
<div class="container text-center">
	<div class="col-sm-3">
		<h3>Danh mục</h3>
		<ul class="list-group">
		<?php
		foreach ($cates as $item) {
			echo "<li class ='list-group-item'><a href=/lab3/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
		  	# code...
		  }  
		?>
	</ul>
	
</div>


	<div class="col-sm-9">
	<h3>Sản phẩm cửa hàng</h3>
	<div class="row">

<?php
	foreach ($prods as $item) {
		?>
		<div class="col-sm-4">
		<img src="<?php echo "/lab3/".$item["Picture"];?>" class="img-responsive" style="width:100%" alt="Images">
		<p class="text-danger"><?php echo $item["ProductName"]; ?></p>
			<p class="text-info"><?php echo $item["Price"]; ?></p>
			
<p>
<a href="/lab3/product_detail.php?id=<?php echo $item["ProductID"]; ?>"><button type="button" class="btn btn-primary">Chi tiết</button></a>

</p>
<p>
<button type="button" class="btn btn-primary" onclick="location.href='/lab3/shopping_cart.php?id=<?php echo $item["ProductID"]; ?>'">Thêm vào giỏ hàng</button></a>
</p>
</div>
<?php } ?>
</div>
</div>
</div>
	<?php	include_once("footer.php");
?>