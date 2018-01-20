<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php'; ?>

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
		'username' 			=	'';
		'first_name'		=	'';
		'last_name'			=	'';
		'email'				=	'';
		'mobile'			=	'';
		'address'			=	'';
		'password'			=	'';
		'confirm_password'	=	''; 
	];

	if ($username == '') {
		$error['username']	=	'username cannot be empty';
	}

	if (strlen($username) < 5) {
		$error['username']	=	'username should have more then 5 charachter';
	}

	exit;











	$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		redirect('login_form.php');
	} else{
			if($password != $confirm_password){
			echo 'password and confirm password should be same';
	} else {
			$password = md5($_POST['password']);
			// $password = md5($password);
			// $password   = password_hash($password, PASSWORD_BCRYPT , array('cost' => 12));
			$query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile) VALUES ('{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$address}', '{$password}', '{$mobile}')";
			$register_user_query = mysqli_query($connection, $query);

			if (!$register_user_query) {
			confirmedQuery($register_user_query);
			} else {

			header("Location:". '../index.php');
			}
	}
	}

}

?>