<?php include '../inc/db.php';?>
<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>


<?php

$per_page = 4;

if (isset($_GET['page'])) {

$page = $_GET['page'];

} else {

$page = "";
}

if ($page == "" || $page == 1) {
$page_1 = 0;
} else {
$page_1 = ($page * $per_page) - $per_page;
}

?>


<h2 class="text-center">Students Records</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>Student ID</th>
        <th>Username</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

		<?php
		
		$query = "SELECT * FROM student_users LIMIT $page_1, $per_page";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$student_id 		= $row['id'];
		$student_username 	= $row['username'];
		$student_email 		= $row['email'];
		$student_first_name = $row['first_name'];
		$student_last_name 	= $row['last_name'];
		$student_mobile 	= $row['mobile'];
		$student_address 	= $row['address'];
		echo '<tr>';
		echo "<td>{$student_id}</td>";
		echo "<td>{$student_username}</td>";
		echo "<td><a href='./detail_dashboard.php?s_id=$student_id&page=$page' class='btn btn-primary btn-block'>View</a></td>";
    echo "</tr>";

	}
  ?>
    </tbody>
  </table>

  <a href="./users_records.php" class="btn btn-default">View Users</a>