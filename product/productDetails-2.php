
<?php include '../inc/db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/product.css">
</head>
<body>

		<header>
		<div class="header">
			<a href="../product/product-2.php"><h2 class="site-name">Product</h2></a>
		</div>
	</header>
	
<div class="grid-container outline">

<?php 

if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
}

$query = "SELECT * FROM product WHERE id = '{$pid}' ";
				$execute_equery = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($execute_equery)) {
				$pimage = $row['pimage'];
				$pname  = $row['pname'];
				$pdesc  = $row['pdesc'];

				echo "<div class='product-image'>
						<img src='../images/products/650x500/$pimage' alt='$pname'>
					  </div>
						
					  <div class='image-desc'><p>$pdesc</p></div>
					  ";
}
?>
</div>

</body>
</html>
