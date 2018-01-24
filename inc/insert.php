<?php include '../inc/db.php';?>


<?php

$password = md5(123456);
for($i=1; $i<=100; $i++){

	$query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile, dob, gender, user_image, age) VALUES ('brij123', 'brij', 'yadav', 'brij123@gmail.com', 'Malad', '{$password}', '9167751696', '1995-01-08', 'Male', 'user', '22')";

	$register_user_query = mysqli_query($connection, $query);
}



?>