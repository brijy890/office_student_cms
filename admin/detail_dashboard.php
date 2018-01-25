
<?php session_start(); ?>
<?php include '../inc/db.php';?>

<?php 

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}

?>
<?php include '../inc/header.php';?>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="../index.php">Student-CMS</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="/">Home</a></li>
		</ul>

		<ul class="nav navbar-nav pull-right">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user'> <?php echo $username; ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="./logout.php">Logout</a>
					</div>
				</li> 
		</ul>
	</div>
</nav>

<div class="container">
  <h2 class="text-center">Students Records</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr class="table-primary">
      	<th>Field</th>
      	<th>Values</th>
      </tr>
    </thead>
    <tbody>

		<?php

		if (isset($_GET['s_id'])) {
			$s_id = $_GET['s_id'];
		}

		//global $connection;
		$query = "SELECT * FROM student_users WHERE id = '{$s_id}'";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$student_id 			= $row['id'];
		$student_username 		= $row['username'];
		$student_email 			= $row['email'];
		$student_first_name 	= $row['first_name'];
		$student_last_name 		= $row['last_name'];
		$student_mobile 		= $row['mobile'];
		$student_address 		= $row['address'];
		$student_dob			= $row['dob'];
		$student_age			= $row['age'];
		$student_gender			= $row['gender'];
		$student_image			= $row['user_image'];

		echo '<tr>';
		echo "<td>Student Image</td><td><img width='50' src='../images/$student_image'></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Username</td><td>{$student_username}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Firstname</td><td>{$student_first_name}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Lastname</td><td>{$student_last_name}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Email</td><td>{$student_email}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Mobile Number</td><td>{$student_mobile}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Date of Birth</td><td>{$student_dob}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Gender</td><td>{$student_gender}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Age</td><td>{$student_age}</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Address</td><td>{$student_address}</td>";
		echo "</tr>";

	}
  ?>
    </tbody>
  </table>

  <a href="./dashboard.php?page=<?php echo $page;?>" class="btn btn-info">Back</a>
</div>

</body>
</html>

