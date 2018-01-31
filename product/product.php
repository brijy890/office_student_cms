<?php include '../inc/header.php';?>

<?php $params = pagination_prams('product');?>

	<div class="container">
		<div class="container product-section">
			<div class="row text-center">

				<?php

				$query = "SELECT * FROM product LIMIT {$params['page_1']}, {$params['per_page']}";
				$execute_equery = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($execute_equery)) {
				$pid 	= $row['id'];
				$pimage = $row['pimage'];
				$pname  = $row['pname'];
				$pdesc  = $row['pdesc'];

				?>
				<div class='col-md-4'>
					<div class='card'>
						<div class='card-header'><h2 class='product-name'><?php echo $pname;?></h2></div>
							<div class='card-body'>
								<a href='../product/productDetails.php?pid=<?php echo $pid;?>'><img class='card-img-top' src='../images/products/250x250/<?php echo $pimage;?>' alt='Card image cap'></a>
								<p class='card-text'><?php echo $pdesc;?></p>
							</div>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>

				<ul class="pager">
					<?php getPager($params['count'], $params['page'], '../product/product.php');?>
				</ul>
	</div>
<?php include '../inc/footer.php';?>
<script>
	
	$(function(){
		$(".card-img-top").hover(function(){
			$(this).toggleClass( "hover" );
		});
	});
</script>