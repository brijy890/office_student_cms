<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
<?php checkConnection();?>


<?php 

if(isset($_POST['register'])){
	
	$username	= trim($_POST['username']);
	$password 	= trim($_POST['password']);

	$password 	= md5($password);
	$role = 'student';

	$error = [
		'username'	=>	'',
		'password'	=>	''
	];

	if (admin_exits($username)) {
		$error['username']	=	'Admin exits';
	}

	foreach ($error as $key => $value) {
        
        if (empty($value)) {

            unset($error[$key]);
        }
    }

    if (empty($error)) {

        adminRegister($username, $password, $role);

    }
	
}

?>

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
        <div class="col-xs-12 col-sm-8 col-md-12 col-sm-offset-2">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Admin Registration</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			    			

			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username">
			    				<?php

			    				if (isset($error['username'])) {
			    					echo "<p class='alert alert-info'>{$error['username']}</p>";
			    				}

			    				?>
			    			</div>


			    			<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
	    					</div>
			    			
			    			<input type="submit" value="Register" class="btn btn-info btn-block" name='register'>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>