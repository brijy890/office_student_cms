<?php session_start(); ?>
<?php include '../inc/db.php';?>

<?php 

if (isset($_SESSION['student_username'])) {
	$student_username = $_SESSION['student_username'];

	if ($_SESSION['student_image']) {
	$image = $_SESSION['student_image'];
	}
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
					<a class="nav-link dropdown-toggle" href="./admin/login_form.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><img width='15' src="<?php echo"../images/$image";?>"></span> <?php echo $student_username; ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="./logout.php">Logout</a>
					</div>
				</li> 
		</ul>
	</div>
</nav>


<div class="container">
  <h2 class="text-center">Students Records</h2>      

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

		if ((mysqli_num_rows($select_user) < 1)) {
			echo "<h1>No records to show</h1>";
		} else{

		?>
		
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Field</th>
      				<th>Values</th>
				</tr>
			</thead>
		<tbody>


    	<?php
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
			
		}

		
  ?>
    </tbody>
  </table>
  <a href="edit.php?student_id=<?php echo $_SESSION['student_id']?>" class="btn btn-primary">Edit</a>
</div>

</body>
</html>

