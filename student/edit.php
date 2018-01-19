<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
<?php checkConnection();?>


<?php

		if (isset($_GET['student_id'])) {
			$s_id = $_GET['student_id'];
		}

		//global $connection;
		$query = "SELECT * FROM student_users WHERE id = '{$s_id}'";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$student_id 		= $row['id'];
		$student_username	= $row['username'];
		$student_email 		= $row['email'];
		$student_first_name = $row['first_name'];
		$student_last_name 	= $row['last_name'];
		$student_mobile 	= $row['mobile'];
		$student_address 	= $row['address'];
	}

?>


 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Student CMS</title>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
</head>
<body>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12 col-sm-offset-2>
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Edit User</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="edit_2.php" name="edit-form">
			    			
			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" required value="<?php echo $student_username; ?>">
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="Firstname" required value="<?php echo $student_first_name; ?>">
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Lastname" required value="<?php echo $student_last_name; ?>">
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required value="<?php echo $student_email; ?>">
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="mobile" id="mobile" class="form-control input-sm" placeholder="Mobile Number" required value="<?php echo $student_mobile; ?>">
			    			</div>

			    			<div class="form-group">
			    				<input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" required value="<?php echo $student_address; ?>">
			    			</div>
			    			
			    			<input type="submit" value="Edit" class="btn btn-info btn-block" name="edit">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>

