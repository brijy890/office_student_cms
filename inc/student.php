<? session_start();?>
<?php include './db.php';?>
<?php include './function.php';?>
<?php 


class Admin {

		private $username;
		private $password;
		private $role;

		function __construct($username, $password, $role){

			$this->username = $username;
			$this->password = $password;
			$this->role     = $role;

		}

		// public function setAdmin($username, $password, $role){

		// 	$this->username = $username;
		// 	$this->password = $password;
		// 	$this->role     = $role;
		// }

		public function registerAdmin(){

			global $connection;
			$query		= "INSERT INTO admin (username, password, role) VALUES ('{$this->username}', '{$this->password}', '{$this->role}')";
			$register_admin_query = mysqli_query($connection, $query);

			confirmedQuery($register_admin_query);

			redirect('../');
		}

		

}

class Student {

		function studentLogin($username, $password){

		global $connection;
		$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
			die("Query failed". mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($select_user)) {
		$db_id		 		= $row['id'];
		$db_username 		= $row['username'];
		$db_password 		= $row['password'];
		$db_student_image	= $row['user_image'];

		}

		if($db_username === $username && $db_password === $password){

		$_SESSION['student_id'] 		= $db_id;
		$_SESSION['student_username'] 	= $db_username;
		$_SESSION['student_image']		= $db_student_image;

		header("Location:". "../student/dashboard.php?student_id= {$db_id}");

		} else {
		header("Location:". "../");

		}
	}

}




?>