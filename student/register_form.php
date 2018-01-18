<?php session_start(); ?>
<?php include './inc/db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student CMS</title>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12 col-sm-offset-2>
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Student Registration</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="register.php" name="registration-form">
			    			
			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" required>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Firstname" required>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Lastname" required>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile Number" required>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" required>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required>
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" name='submit'>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>