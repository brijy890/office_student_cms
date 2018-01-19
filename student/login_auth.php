<?php session_start(); ?>
<?php include '../inc/class_student.php'; ?>
<?php include '../inc/db.php';?>

<?php 
$student = new Student();
if(isset($_POST['login'])){
	
	$login_username = $_POST['username'];
	$login_password = md5($_POST['password']);
	$student->studentLogin($login_username, $login_password);
}



?>