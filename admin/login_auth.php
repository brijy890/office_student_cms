<?php session_start(); ?>

<?php include '../inc/function.php'; ?>
<?php include '../inc/db.php';?>

<?php 

if(isset($_POST['login'])){
	//global $connection;
	$login_username = trim($_POST['username']);
	$login_password = trim($_POST['password']);

	$query = "SELECT * FROM admin WHERE username = '{$login_username}' ";
	$select_user = mysqli_query($connection, $query);

	if (!$select_user) {
		confirmedQuery($select_user);
	}	
	// if (!$select_user) {
	// 	die("QUERY FAILED ".mysqli_error($connection));
	// } 

	while ($row = mysqli_fetch_assoc($select_user)) {
		$db_username = $row['username'];
		$db_password = $row['password'];

	}
	
	if($db_username == $login_username && $db_password == $login_password){

		$_SESSION['username'] 	= $db_username;
		$_SESSION['password'] 	= $db_password;

		redirect("./dashboard.php");
		// header("Location:". 'dashboard.php');
	} else {
		redirect("index.php");
		// header("Location:". 'index.php');
		
	}
}

?>