<?php include '../inc/header.php'; ?>

<?php

if(isset($_POST['submit'])){

	$username			= trim($_POST['username']);
	$first_name			= trim($_POST['first_name']);
	$last_name			= trim($_POST['last_name']);
	$email 				= trim($_POST['email']);
	$mobile 			= trim($_POST['mobile']);
	$address			= trim($_POST['address']);
	$gender 			= trim($_POST['gender']);
	$dob 				= trim($_POST['dob']);
	$user_image 		= $_FILES['user_image']['name'];
	$user_image_temp 	= $_FILES['user_image']['tmp_name'];
	$password 			= trim($_POST['password']);
	$confirm_password 	= trim($_POST['password_confirmation']);

	if ($user_image == '') {
		$user_image = 'user.png';
	}

	$date = date(DATE_ATOM);

	$age = $date - $dob;

	move_uploaded_file($user_image_temp, "../images/users/$user_image");

	exit;

	$error = [
		'username' 			=>	'',
		'first_name'		=>	'',
		'last_name'			=>	'',
		'email'				=>	'',
		'mobile'			=>	'',
		'address'			=>	'',
		'gender'			=>	'',
		'dob'				=>	'',
		'password'			=>	'',
		'confirm_password'	=>	'',
		'msg'				=>	''
	];


	$error['username'] 	= usernameValidate($username);
	if (empty($error['username'])) {
		$error['first_name'] 	= firstnameValidate($first_name);

			if (empty($error['first_name'])) {
			$error['last_name'] 	= lirstnameValidate($last_name);

				if (empty($error['last_name'])) {
				$error['email'] 	= emailValidate($email);

					if (empty($error['email'])) {
					$error['mobile'] 	= mobileValidate($mobile);

						if (empty($error['mobile'])) {
						$error['address'] 	= addressValidate($address);

							if (empty($error['address'])) {
							$error['gender'] 	= genderValidate($gender);

								if (empty($error['gender'])) {
								$error['dob'] 	= dobValidate($dob);

									if (empty($error['dob'])) {
									$error['password'] 	= passwordValidate($password, $confirm_password);

										if (empty($error['password'])) {
											$password = md5($password);
										}
								}
							}
						}
					}
				}
			}
		}
	}

	foreach ($error as $key => $value) {
        
        if (empty($value)) {

            unset($error[$key]);
        } 
    }

    if (empty($error)) {

studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $dob, $gender, $password, $user_image, $age);

    }
}
?>

	
	<div class="container">
		<p><?php echo isset($error['msg']) ? $error['msg'] : ''; ?></p>
        <div class="row centered-form">
        <div class="col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Student Registration</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="registration-form" enctype="multipart/form-data">
			    			
			    			<div class="form-group">
			    				<span id="Uerror"></span>
			    				<input type="text" name="username" id="username" onkeyup="validateUsername(this.value)" class="form-control input-sm validate" placeholder="Username" 
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
								<span id="Eerror"></span>
								<input type="email" name="email" id="email" class="form-control input-sm validate" placeholder="Email Address"
								value="<?php echo isset($email) ? $email : ''; ?>">
								<?php 

								if(isset($error['email'])){
									echo "<p class='alert alert-info'>{$error['email']}</p>";
								}

								?>
							</div>

			    			<div class="form-group">
			    				<span id="Merror"></span>
			    				<input type="tel" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile Number"
			    				value="<?php echo isset($mobile) ? $mobile : ''; ?>" onkeyup="validateMobile()">
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
			    						<input type="date" name="dob" id="dob" class="form-control input-sm">
			    						
									<?php 

									if(isset($error['dob'])){
									echo "<p class='alert alert-info'>{$error['dob']}</p>";
									}

									?>

			    					</div>
			    				</div>

			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
										<select class="form-control" id="gender" name="gender">
										<option value="">Select Gender</option>
										<option value="male">Male</option>
										<option value="female">Female</option>
										</select>

										<?php 

										if(isset($error['gender'])){
										echo "<p class='alert alert-info'>{$error['gender']}</p>";
										}

										?>

			    					</div>
			    				</div>


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

			    			<div class="form-group">
			    				<input type="file" name="user_image" id="image">
			    			</div>
			    			
			    			<input type="submit" value="Register" class="btn btn-primary btn-block" name='submit'>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

<?php include '../inc/footer.php';?>

<!-- <script>
	
	$(function(){
		
		$( "form" ).submit(function( event ) {
		
		var input = $( this ).serializeArray();
		console.log(input);

		var username = $(input[0]);
		if (username[value = '']) {
			alert("username cannot be blank");
		}
		console.log(username);
		event.preventDefault();
		});

	});
</script> -->