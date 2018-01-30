
<?php include '../inc/header.php'; ?>


<?php 

if (isset($_GET['pid'])) {
	$pid = $_GET['pid'];
}


$query = "SELECT * FROM product WHERE id = '{$pid}'";
$query = mysqli_query($connection, $query);
confirmedQuery($query);
while ($row = mysqli_fetch_assoc($query)) {
	$db_pname 		= $row['pname'];
	$db_pdesc 		= $row['pdesc'];
	$db_pimage 		= $row['pimage'];
	$db_price 		= $row['price'];
}


if(isset($_POST['edit'])){

	$pname	= trim($_POST['pname']);
	$pdesc 	= trim($_POST['pdesc']);
	$price  = trim($_POST['price']);

	if(isset($_FILES['pimage'])){

		$errors		= array();
		$file_name 	= $_FILES['pimage']['name'];

		if (empty($file_name)) {
			$file_name = $db_pimage;

			$query = "UPDATE product SET pname = '{$pname}', pdesc = '{$pdesc}', price = '{$price}', pimage = '{$file_name}' WHERE id = '{$pid}'";
			$execute_query = mysqli_query($connection, $query);

			if (!$execute_query) {
				die("Failed". mysqli_error($connection));
			}

			delete_image($db_pimage);
			header("Location: ../product/product-2.php");
			
		} else{

		$file_size 	= $_FILES['pimage']['size'];
		$file_tmp 	= $_FILES['pimage']['tmp_name'];
		$file_type	= $_FILES['pimage']['type'];
		$file_ext	= strtolower(end(explode('.',$_FILES['pimage']['name'])));

		$expensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$expensions)=== false){
			$errors['file_ext']="extension not allowed, please choose a JPEG or PNG file.";
		}

		if($file_size > 2097152){
			$errors['file_size']='File size must be excately 2 MB';
		}

		if(empty($errors)==true){

			$file_name = uniqid();
			$file_name = $file_name . "." . $file_ext;

			move_uploaded_file($file_tmp,"../images/products/original/".$file_name);
			
			make_thumb('../images/products/original/'.$file_name, '../images/products/250x250/'.$file_name, 250);
			make_thumb('../images/products/original/'.$file_name, '../images/products/300x300/'.$file_name, 300);
			make_thumb('../images/products/original/'.$file_name, '../images/products/650x500/'.$file_name, 650);

			// mmake_thumb_2($file_name, '../images/products/original/'.$file_name, '', $thumb = TRUE, '../images/products/250x250/'.$file_name, 250, 250);




			$query = "UPDATE product SET pname = '{$pname}', pdesc = '{$pdesc}', price = '{$price}', pimage = '{$file_name}' WHERE id = '{$pid}'";

			$execute_query = mysqli_query($connection, $query);

			if (!$execute_query) {
				die("Failed". mysqli_error($connection));
			}

			delete_image($db_pimage);
			header("Location: ../product/product-2.php");
		}
	}
}
}

?>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Upload Product</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="" enctype="multipart/form-data">
			    			

			    			<div class="form-group">
			    				<input type="text" name="pname" id="pname" class="form-control input-sm" placeholder="Product name" 
			    				value="<?php echo $db_pname;?>">
			    				<?php

			    				if (isset($error['pname'])) {
			    					echo "<p class='alert alert-info'>{$error['pname']}</p>";
			    				}

			    				?>
			    			</div>

			    			<div class="form-group">
	    						<input type="text" name="price" placeholder="Enter price" class="form-control" value="<?php echo $db_price;?>">
	    					</div>


			    			<div class="form-group">
			    					 <label for="pdesc">Product Description</label>
  									 <textarea class="form-control" rows="5" id="pdesc" name="pdesc"><?php echo $db_pdesc;?></textarea>	
	    					</div>

	    					

	    					<div class="form-group">
	    						<span class="text-danger">
	    						<?php 

	    							if (isset($errors['file_size'])) {
	    								echo $errors['file_size'];
	    							}

	    						?>
	    						</span>
			    				<input type="file" name="pimage" id="image">
			    			</div>
			    			
			    			<input type="submit" value="Edit" class="btn btn-info btn-block" name="edit">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>