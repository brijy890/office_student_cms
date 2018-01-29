
<?php include '../inc/header.php'; ?>


<?php 

if(isset($_POST['uplaod'])){
	
	$pname				= trim($_POST['pname']);
	$pdesc 				= trim($_POST['pdesc']);

	if(isset($_FILES['pimage'])){
		$errors		= array();
		$file_name 	= $_FILES['pimage']['name'];
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
			move_uploaded_file($file_tmp,"../images/products/original/".$file_name);
			
			make_thumb('../images/products/original/'.$file_name, '../images/products/250x250/'.$file_name, 250);
			make_thumb('../images/products/original/'.$file_name, '../images/products/300x300/'.$file_name, 300);
			make_thumb('../images/products/original/'.$file_name, '../images/products/650x500/'.$file_name, 650);
			$query = "INSERT INTO product (pname, pdesc, pimage) VALUES ('{$pname}', '{$pdesc}', '{$file_name}')";
			$execute_query = mysqli_query($connection, $query);
			header("Location: ../product/product.php");
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
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
			    			

			    			<div class="form-group">
			    				<input type="text" name="pname" id="pname" class="form-control input-sm" placeholder="Product name" 
			    				value="<?php echo isset($pname) ? $pname : '';?>">
			    				<?php

			    				if (isset($error['pname'])) {
			    					echo "<p class='alert alert-info'>{$error['pname']}</p>";
			    				}

			    				?>
			    			</div>


			    			<div class="form-group">
			    					 <label for="comment">Product Description</label>
  									 <textarea class="form-control" rows="5" id="pdesc" name="pdesc"></textarea>	
	    					</div>

	    					<div class="form-group">
	    						<span class="text-danger">
	    						<?php 

	    							if (isset($errors['file_ext'])) {
	    								echo $errors['file_ext'];
	    							} else if (isset($errors['file_size'])) {
	    								echo $errors['file_size'];
	    							}

	    						?>
	    						</span>
			    				<input type="file" name="pimage" id="image">
			    			</div>
			    			
			    			<input type="submit" value="Upload" class="btn btn-info btn-block" name="uplaod">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>