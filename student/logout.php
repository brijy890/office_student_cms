<?php ob_start();?>
<?php session_start(); ?>

<?php 

$_SESSION['student_username'] 	= null;
$_SESSION['student_id'] 	= null;

header("Location: ../index.php");
?>