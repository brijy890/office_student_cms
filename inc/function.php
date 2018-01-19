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

?> 