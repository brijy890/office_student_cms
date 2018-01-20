
<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
<?php checkConnection();?>

<?php 

if (isset($_SESSION['student_id'])) {
	$s_id = $_SESSION['student_id'];
}

if(isset($_POST['edit'])){

	$username			= $_POST['username'];
	$first_name			= $_POST['first_name'];
	$last_name			= $_POST['last_name'];
	$email 				= $_POST['email'];
	$mobile 			= $_POST['mobile'];
	$address			= $_POST['address'];

	$query = "UPDATE student_users SET username = '{$username}', first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', mobile = '{$mobile}', address = '{$address}' WHERE id = '{$s_id}' ";
			$register_user_query = mysqli_query($connection, $query);

			if (!$register_user_query) {
				confirmedQuery($register_user_query);
			} else {
				header("Location:". "dashboard.php?student_id=$s_id");
			}
}

?>