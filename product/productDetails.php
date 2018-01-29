<?php include '../inc/header.php';?>
<?php include '../inc/db.php';?>


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
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img src="../images/products/original/<?php echo $pimage;?>" alt="<?php echo $pname;?>">
		</div>

		<div class="col-md-6">
			<p><?php echo $pdesc ;?></p>
		</div>
	</div>
</div>



<?php include '../inc/footer.php';?>