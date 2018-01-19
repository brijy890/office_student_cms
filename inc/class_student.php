<? session_start();?>
<?php include './db.php';?>
<?php include './function.php';?>
<?php 

class Student {

		function studentLogin($username, $password){

		global $connection;
		$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
		$select_user = mysqli_query($connection, $query);

		// confirmedQuery($select_user);

		if (!$select_user) {
			die("Query failed". mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($select_user)) {
		$db_id		 = $row['id'];
		$db_username = $row['username'];
		$db_password = $row['password'];

		}

		if($db_username === $username && $db_password === $password){

		$_SESSION['student_id'] 		= $db_id;
		$_SESSION['student_username'] 	= $db_username;

		header("Location:". "../student/dashboard.php?student_id= {$db_id}");

		} else {
		header("Location:". "../index.php");

		}
	}

}




?>