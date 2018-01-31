
<?php include '../inc/header.php'; ?>


<?php
$product_data = get_product_data();
$errors = edit_product($product_data['pid'], $product_data['db_pimage']);
?>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Edit Product</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="" enctype="multipart/form-data">
			    			

			    			<div class="form-group">
			    				<input type="text" name="pname" id="pname" class="form-control input-sm" placeholder="Product name" 
			    				value="<?php echo $product_data['db_pname'];?>">
			    				<?php

			    				if (isset($error['pname'])) {
			    					echo "<p class='alert alert-info'>{$error['pname']}</p>";
			    				}

			    				?>
			    			</div>

			    			<div class="form-group">
	    						<input type="text" name="price" placeholder="Enter price" class="form-control" value="<?php echo $product_data['db_price'];?>">
	    					</div>


			    			<div class="form-group">
			    					 <label for="pdesc">Product Description</label>
  									 <textarea class="form-control" rows="5" id="pdesc" name="pdesc"><?php echo $product_data['db_pdesc'];?></textarea>	
	    					</div>

	    					<div class="form-group">
	    						<span class="text-danger">
	    						<?php 

	    							if (isset($errors['file_ext'])) {
	    								echo $errors['file_ext'];
	    							}

	    							if(isset($errors['file_size'])){
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