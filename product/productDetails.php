<?php include '../inc/header.php';?>

<?php 

if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
}

$col 	= array();
$params = array('id' => $pid);
$db_result = selectQuery('product', $col, $params);
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img src="../images/products/650x500/<?php echo $db_result['pimage'];?>" alt="<?php echo $db_result['pname'];?>">
		</div>

		<div class="col-md-6">
			<p><?php echo $db_result['pdesc'] ;?></p>
		</div>
	</div>
</div>



<?php include '../inc/footer.php';?>