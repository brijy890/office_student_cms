<?php ob_start();?>
<?php session_start(); ?>

<?php 

$_SESSION['student_username'] 	= null;

header("Location: ../index.php");
?>