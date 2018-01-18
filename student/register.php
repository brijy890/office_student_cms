<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php'; ?>

<?php 

if(isset($_POST['submit'])){
	global $connection;

	$username			= $_POST['username'];
	$first_name			= $_POST['first_name'];
	$last_name			= $_POST['last_name'];
	$email 				= $_POST['email'];
	$mobile 			= $_POST['mobile'];
	$address			= $_POST['address'];
	$password 			= $_POST['password'];
	$confirm_password 	= $_POST['password_confirmation'];


	$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	echo $count;

	if ($count > 0) {
		redirect('register_form.php');
		$_SESSION['error'] = 'Username already exits';
	}

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

?>