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

//studentValidate
// function studentValidate(){

// 	global $connection;
// // 	if(isset($_POST['submit'])){
	
// // 	$username			= trim($_POST['username']);
// // 	$first_name			= trim($_POST['first_name']);
// // 	$last_name			= trim($_POST['last_name']);
// // 	$email 				= trim($_POST['email']);
// // 	$mobile 			= trim($_POST['mobile']);
// // 	$address			= trim($_POST['address']);
// // 	$password 			= trim($_POST['password']);
// // 	$confirm_password 	= trim($_POST['password_confirmation']);

// // 	$error = [
// // 		'username' 			=>	'',
// // 		'first_name'		=>	'',
// // 		'last_name'			=>	'',
// // 		'email'				=>	'',
// // 		'mobile'			=>	'',
// // 		'address'			=>	'',
// // 		'password'			=>	'',
// // 		'confirm_password'	=>	'',
// // 		'msg'				=>	''
// // 	];

// // 	if ($username == '') {
// // 		$error['username']	=	'username cannot be empty';
// // 	} else {
// // 			if (strlen($username) < 5) {
// // 				$error['username']	=	'username should have more then 5 charachter';
// // 			} else {
// // 				if (user_exits($username)) {
// // 					$error['username']	=	"Username exits, <a href='login_form.php' class='btn btn-primary'>Login</a>";
// // 				}
// // 			}
// // 	}

// // 	if ($first_name == '') {
// // 		$error['first_name']	=	'Firstname cannot be empty';
// // 	}

// // 	if ($last_name == '') {
// // 		$error['last_name']		=	'last_name cannot be empty';
// // 	}

// // 	if ($email == '') {
// // 		$error['email']			=	'Email cannot be empty';
// // 	} else{
// // 		if (email_exits($email)) {
// // 			$error['email']		=	'This email id already exits';
// // 		}
// // 	}

// // 	if ($mobile == '') {
// // 		$error['mobile']		=	'Mobile number cannot be empty';
// // 	} else{
// // 		if ((strlen($mobile)) != 10) {
// // 			$error['mobile']	=	'Mobile number should be of 10 digits';
// // 		} else {
// // 			if (mobile_exits($mobile)) {
// // 				$error['mobile']	=	'This mobile no already exits';
// // 			}
// // 		}
// // 	}

// // 	if ($address == '') {
// // 		$error['address']		=	'Address cannot be empty';
// // 	}

// // 	if ($password == '') {
// // 		$error['password']	=	'Password cannot be empty';
// // 	}	else if ($confirm_password == '') {
// // 		$error['confirm_password']	=	'Confirm password cannot be empty';
// // 	}	else if ($password != $confirm_password) {
// // 		$error['msg']	=	'Password and confirm_password should be same';
// // 	}	else{
// // 		$password = md5($password);
// // 	}





// // 	foreach ($error as $key => $value) {
        
// //         if (empty($value)) {

// //             unset($error[$key]);
// //         } else
// //         {
// //         	return $error;
// //         }
// //     }

// //     if (empty($error)) {

// //         studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $password);

// //     }
// // }
// }



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

?> 