
<?php include '../inc/db.php';?>



 
<?php

if (isset($_GET['q'])) { 
	$q = intval($_GET['q']);
} 
$per_page = $q;

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

$student_count_query = "SELECT * FROM student_users";
$student_query = mysqli_query($connection, $student_count_query);
$count = mysqli_num_rows($student_query);

$count = ceil($count / $per_page);

?>

<div class="container">
  <h2 class="text-center">Students Records</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>Student ID</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>

		<?php
		global $connection;
		$query = "SELECT * FROM student_users LIMIT $page_1, $per_page";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$student_id = $row['id'];
		$student_username = $row['username'];
		$student_email = $row['email'];
		$student_first_name =$row['first_name'];
		$student_last_name = $row['last_name'];
		$student_mobile = $row['mobile'];
		$student_address = $row['address'];
		echo '<tr>';
		echo "<td>{$student_id}</td>";
		echo "<td>{$student_username}</td>";
		echo "<td><a href='./detail_dashboard.php?s_id=$student_id' class='btn btn-primary btn-block'>View</a></td>";

	}
  ?>
    </tbody>
  </table>
  <a href="./users_records.php" class="btn btn-default">View Users</a>
</div>

<ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                     echo "<li><a class='active_link' href='dashboard.php?page={$i}'>{$i}</a></li>";
                 } else{
                     echo "<li><a href='dashboard.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>