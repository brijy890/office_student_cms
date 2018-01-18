<?php session_start(); ?>
<?php include '../inc/db.php';?>

<?php 

if (isset($_SESSION['student_id'])) {
	$s_id = $_SESSION['student_id'];
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student CMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


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
					<a class="nav-link dropdown-toggle" href="./admin/login_form.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $s_id; ?></a>
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
      <tr>
      	<th>Student ID</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>

		<?php
		// global $connection;
		if (isset($_GET['student_id'])) {
			$s_id = $_GET['student_id'];
		}
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
		echo '<tr>';
		echo "<td>{$student_id}</td>";
		echo "<td>{$student_username}</td>";
		 echo "<td><a href='./dashboard-2.php?s_id=$student_id' class='btn btn-primary btn-block'>View</a></td>";

	}
  ?>
    </tbody>
  </table>
</div>

</body>
</html>

