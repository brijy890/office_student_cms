<?php session_start(); ?>

<?php include '../inc/function.php'; ?>
<?php include '../inc/db.php';?>

<?php 

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

?>