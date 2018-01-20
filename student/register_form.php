<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
<?php checkConnection();?>

<?php 

if(isset($_POST['submit'])){
	
	$username			= trim($_POST['username']);
	$first_name			= trim($_POST['first_name']);
	$last_name			= trim($_POST['last_name']);
	$email 				= trim($_POST['email']);
	$mobile 			= trim($_POST['mobile']);
	$address			= trim($_POST['address']);
	$password 			= trim($_POST['password']);
	$confirm_password 	= trim($_POST['password_confirmation']);


	$error = [
		'username' 			=>	'',
		'first_name'		=>	'',
		'last_name'			=>	'',
		'email'				=>	'',
		'mobile'			=>	'',
		'address'			=>	'',
		'password'			=>	'',
		'confirm_password'	=>	'',
		'msg'				=>	''
	];

	if ($username == '') {
		$error['username']	=	'username cannot be empty';
	} else {
			if (strlen($username) < 5) {
				$error['username']	=	'username should have more then 5 charachter';
			} else {
				if (user_exits($username)) {
					$error['username']	=	"Username exits, <a href='login_form.php' class='btn btn-primary'>Login</a>";
				}
			}
	}

	// if ($first_name == '') {
	// 	$error['first_name']	=	'Firstname cannot be empty';
	// }

	// if ($last_name == '') {
	// 	$error['last_name']		=	'last_name cannot be empty';
	// }

	if ($email == '') {
		$error['email']			=	'Email cannot be empty';
	} else{
		if (email_exits($email)) {
			$error['email']		=	'This email id already exits';
		}
	}

	if ($mobile == '') {
		$error['mobile']		=	'Mobile number cannot be empty';
	} else{
		if ((strlen($mobile)) != 10) {
			$error['mobile']	=	'Mobile number should be of 10 digits';
		} else {
			if (mobile_exits($mobile)) {
				$error['mobile']	=	'This mobile no already exits';
			}
		}
	}

	// if ($address == '') {
	// 	$error['address']		=	'Address cannot be empty';
	// }

	if ($password == '') {
		$error['password']	=	'Password cannot be empty';
	}	else if ($confirm_password == '') {
		$error['confirm_password']	=	'Confirm password cannot be empty';
	}	else if ($password != $confirm_password) {
		$error['msg']	=	'Password and confirm_password should be same';
	}	else{
		$password = md5($password);
	}





	foreach ($error as $key => $value) {
        
        if (empty($value)) {

            unset($error[$key]);
        }
    }

    if (empty($error)) {

        studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $password);

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
		<p><?php echo isset($error['msg']) ? $error['msg'] : ''; ?></p>
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12 col-sm-offset-2>
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Student Registration</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="register_form.php" name="registration-form">
			    			
			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username"
			    				value="<?php echo isset($username) ? $username : ''; ?>">

			    				<?php 

			    				if(isset($error['username'])){
			    					echo "<p class='alert alert-info'>{$error['username']}</p>";
			    				}
			    	
			    				?>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Firstname"
			    				value="<?php echo isset($first_name) ? $first_name : ''; ?>">
			    				<?php 

			    				if(isset($error['first_name'])){
			    					echo "<p class='alert alert-info'>{$error['first_name']}</p>";
			    				}
			    	
			    				?>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Lastname"
			    				value="<?php echo isset($last_name) ? $last_name : ''; ?>">

			    				<?php 

			    				if(isset($error['last_name'])){
			    					echo "<p class='alert alert-info'>{$error['last_name']}</p>";
			    				}
			    	
			    				?>

			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address"
			    				value="<?php echo isset($email) ? $email : ''; ?>">
			    				<?php 

			    				if(isset($error['email'])){
			    					echo "<p class='alert alert-info'>{$error['email']}</p>";
			    				}
			    	
			    				?>
			    			</div>

			    			<div class="form-group">
			    				<input type="tel" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile Number"
			    				value="<?php echo isset($mobile) ? $mobile : ''; ?>">
			    				<?php 

			    				if(isset($error['mobile'])){
			    					echo "<p class='alert alert-info'>{$error['mobile']}</p>";
			    				}
			    	
			    				?>
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address"
			    				value="<?php echo isset($address) ? $address : ''; ?>">
			    				<?php 

			    				if(isset($error['address'])){
			    					echo "<p class='alert alert-info'>{$error['address']}</p>";
			    				}
			    	
			    				?>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    						<?php 

			    				if(isset($error['password'])){
			    					echo "<p class='alert alert-info'>{$error['password']}</p>";
			    				}
			    	
			    				?>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    						<?php 

			    				if(isset($error['confirm_password'])){
			    					echo "<p class='alert alert-info'>{$error['confirm_password']}</p>";
			    				}
			    	
			    				?>
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

<!--     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'en'
  });
</script> -->

</body>
</html>