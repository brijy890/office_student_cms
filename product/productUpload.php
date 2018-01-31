
<?php include '../inc/header.php'; ?>
<?php $errors = upload_product();?>

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
	    						<input type="text" name="price" placeholder="Enter price" class="form-control">
	    					</div>


			    			<div class="form-group">
			    					 <label for="pdesc">Product Description</label>
  									 <textarea class="form-control" rows="5" id="pdesc" name="pdesc"></textarea>	
	    					</div>

	    					

	    					<div class="form-group">
	    						<span class="text-danger">
	    						<?php 

	    							if (isset($errors['file_ext'])) {
	    								echo $errors['file_ext'];
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