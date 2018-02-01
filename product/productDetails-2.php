
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
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

$col 	= array();
$params = array('id' => $pid);
$db_result = selectQuery('product', $col, $params);

echo "<div class='product-image'>
<img src='../images/products/650x500/{$db_result['pimage']}' alt='{$db_result['pname']}'>
</div>

<div class='image-desc'><p>{$db_result['pdesc']}</p></div>
					  ";
?>
</div>

</body>
</html>
