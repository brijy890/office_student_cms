<?php ob_start();?>

<?php 

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "brij@1234";
$db['db_name'] = "student-cms";

foreach ($db as $key => $value) {
	define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if (!$connection) {
// 	header("Location:" . "../");
// } 
// else{
// 	echo "connected";
// }
?>
