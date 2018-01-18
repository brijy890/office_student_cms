<?php include('./inc/db.php'); ?>

<?php 

// Redirect function
function redirect($location){
	global $connection;
	return header("Location:". $location);
}

function confirmedQuery($query){
	global $connection;
	die("Query Failed" . mysqli_error($connection, $query));
}

?> 