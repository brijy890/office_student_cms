<?php include '../inc/header.php';?>

<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>


<?php 
$params = pagination_prams('student_users');

$per_page 	= $params['per_page'];
$page_1 	= $params['page_1'];
$row_count 	= $params['row_count'];
$count 		= $params['count'];
$page 		= $params['page'];
?>

<?php

if ($row_count <= 0) {
  echo "<h1 class='text-center'>No records</h1>";
} else{
  ?>


<div class="container">
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
  <ul class="pager">
    <?php getPager($count, $page, '../admin/dashboard.php');?>
  </ul>
</div>

<?php } ;?>

<?php include '../inc/footer.php';?>
