<?php session_start(); ?>
<?php include('./inc/db.php'); ?>
<?php include '../inc/class_student.php'; ?>

<?php 

// Redirect function
function redirect($location){
	global $connection;
	return header("Location:". $location);
}

function confirmedQuery($query){

	global $connection;
	if(!$query){
		die(mysqli_error($connection, $query));
	}
}

//student registration
function studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $dob, $gender, $password, $user_image, $age){
	global $connection;

	$query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile, dob, gender, user_image, age) VALUES ('{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$address}', '{$password}', '{$mobile}', '{$dob}', '{$gender}', '{$user_image}', '{$age}')";

	$register_user_query = mysqli_query($connection, $query);

	confirmedQuery($register_user_query);

	redirect("../student/login.php");
}

// student login function
function studentLogin(){

	global $connection;
	$student = new Student();
	if(isset($_POST['login'])){
	$login_username = $_POST['username'];
	$login_password = md5($_POST['password']);
	$student->studentLogin($login_username, $login_password);
	}
}

// admin registration
function adminRegister($username, $password, $role){

	global $connection;
	$query		= "INSERT INTO admin (username, password, role) VALUES ('{$username}', '{$password}', '{$role}')";
	$register_admin_query = mysqli_query($connection, $query);

	confirmedQuery($register_admin_query);

	redirect('../');
}


//admin login function
function adminLogin(){

	global $connection;
	if(isset($_POST['login'])){
		
		$login_username = trim($_POST['username']);
		$login_password = trim($_POST['password']);

		$login_password = md5($login_password);

		$query = "SELECT * FROM admin WHERE username = '{$login_username}' ";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
			confirmedQuery($select_user);
		}	

		while ($row = mysqli_fetch_assoc($select_user)) {
			$db_username	= $row['username'];
			$db_password 	= $row['password'];
			$db_role 		= $row['role'];

		}

		
		if ($db_role === 'admin') {

				if($db_username == $login_username && $db_password == $login_password){

				$_SESSION['username'] 	= $db_username;
				$_SESSION['password'] 	= $db_password;

				redirect("./dashboard.php");
				// header("Location:". 'dashboard.php');
			} else {
				redirect("../index.php");
				// header("Location:". 'index.php');
				
			}
		} else{
			if (admin_exits($db_username)) {
				redirect("../");
			}else{
				redirect("../admin/register.php");
			}
		}
		
	}
}

//admin exits
function admin_exits($username){

	global $connection;
	$query = "SELECT * FROM admin WHERE username = '{$username}' ";
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

function usernameValidate($username){

	global $connection;
	$message = '';
	if ($username == '') {
		$message = 'username cannot be empty';
	} else{
		if (strlen($username) < 5)
		{
			$message =	'username should have more then 5 charachter';
		} else{
			if (user_exits($username)) 
			{
				$message	=	"Username exits, <a href='login.php' class='btn btn-primary'>Login</a>";
			}
		}
	}
	return $message;
}

function firstnameValidate($first_name){

	global $connection;
	$message = '';
	if ($first_name == '') {
		$message = 'Firstname cannot be empty';
	} else{
			if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) 
			{
				$message = "Only letters and white space allowed";
			}
	}
	return $message;
}

function lirstnameValidate($last_name){

	global $connection;
	$message = '';
	if ($last_name == '') {
		$message = 'Lastname cannot be empty';
	} else{
			if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) 
			{
				$message = "Only letters and white space allowed";
			}
	}
	return $message;
}


function emailValidate($email){

	global $connection;
	$message = '';
	if ($email == '') {
		$message			=	'Email cannot be empty';
		} else{
		if (email_exits($email)) {
			$message		=	'This email id already exits';
		}
	}
	return $message;
}

function mobileValidate($mobile){

	global $connection;
	$message = '';

	if ($mobile == '') {
		$message		=	'Mobile number cannot be empty';
	} else{
		if ((strlen($mobile)) != 10) {
			$message	=	'Mobile number should be of 10 digits';
		} else {
			if (mobile_exits($mobile)) {
				$message	=	'This mobile no already exits';
			}
		}
	}
	return $message;
}

function addressValidate($address){

	global $connection;
	$message = '';

	if ($address == '') {
		$message		=	'Address cannot be empty';
	}
	return $message;
}

function genderValidate($gender){

	global $connection;
	$message = '';

	if ($gender == ''){
		$message =	'Gender cannot be empty';
	}
	return $message;
}

function dobValidate($dob){

	global $connection;
	$message = '';

	if ($dob == '') {
		$message		=	'DOB cannot be empty';
	}
	return $message;
}


function  passwordValidate($password, $confirm_password){

	global $connection;
	$message = '';

	if ($password == '') {
		$message	=	'Password cannot be empty';
	} else{
		if ($password != $confirm_password) {
			$message = 'Password and confirm password does not matched';
		}
	}
	return $message;
}



?> 