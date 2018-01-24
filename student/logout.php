<?php ob_start();?>
<?php session_start(); ?>

<?php 

// $_SESSION['student_id'] 		= null;
// $_SESSION['student_username'] 	= null;
// $_SESSION['student_image']		= null;
session_destroy();


header("Location: ../index.php");
?>