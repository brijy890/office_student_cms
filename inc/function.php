<?php session_start(); ?>
<?php include('./inc/db.php'); ?>

<?php 

// Redirect function
function redirect($location){
	global $connection;
	return header("Location:". $location);
}

function confirmedQuery($query){

	global $connection;
	if(!$query){
		die("Query Failed" . mysqli_error($connection, $query));
	}
}


//student registration
function studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $password){

	global $connection;
	// $password = md5($password);
	// $password   = password_hash($password, PASSWORD_BCRYPT , array('cost' => 12));
	$query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile) VALUES ('{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$address}', '{$password}', '{$mobile}')";
	$register_user_query = mysqli_query($connection, $query);

	if (!$register_user_query) {
	confirmedQuery($register_user_query);
	} else {
	header("Location:". '../student/login_form.php');
	}
}

// student login function
function studentLogin($username, $password){

	global $connection;
	$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
	$select_user = mysqli_query($connection, $query);

	confirmedQuery($select_user);

	while ($row = mysqli_fetch_assoc($select_user)) {
	$db_id		 = $row['id'];
	$db_username = $row['username'];
	$db_password = $row['password'];

	}

	if($db_username == $username && $db_password == $password){

	$_SESSION['student_id'] 		= $db_id;
	$_SESSION['student_username'] 	= $db_username;
	$_SESSION['password'] 			= $db_password;

	redirect("dashboard.php?student_id= {$db_id}");
	} else {
	redirect("../index.php");

	}
}

function checkConnection(){
	global $connection;
	
	if (!$connection) {
	header("Location:". "../");
}
}

function user_exits($username){

	global $connection;
	$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

function email_exits($email){

	global $connection;
	$query = "SELECT * FROM student_users WHERE email = '{$email}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

function mobile_exits($mobile){

	global $connection;
	$query = "SELECT * FROM student_users WHERE mobile = '{$mobile}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

?> 