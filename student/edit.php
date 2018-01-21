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

<?php 

if (isset($_SESSION['student_id'])) {
	$s_id = $_SESSION['student_id'];
}

if(isset($_POST['edit'])){

	$username			= $_POST['username'];
	$first_name			= $_POST['first_name'];
	$last_name			= $_POST['last_name'];
	$email 				= $_POST['email'];
	$mobile 			= $_POST['mobile'];
	$address			= $_POST['address'];

	$query = "UPDATE student_users SET username = '{$username}', first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', mobile = '{$mobile}', address = '{$address}' WHERE id = '{$s_id}' ";
			$register_user_query = mysqli_query($connection, $query);

			if (!$register_user_query) {
				confirmedQuery($register_user_query);
			} else {
				header("Location:". "dashboard.php?student_id=$s_id");
			}
}

?>

<?php include '../inc/header.php';?>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="/">Student-CMS</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="/">Home</a></li>
		</ul>
		
		<?php 

		if (isset($_SESSION['username'])) {
			echo "<ul class='nav navbar-nav pull-right'>
					<li><a href='./admin/dashboard.php'><span class='glyphicon glyphicon-user'></span> {$_SESSION['username']}</a></li>
				</ul>";
		} else if(isset($_SESSION['student_username'])){
			echo "<ul class='nav navbar-nav pull-right'>
					<li><a href='../student/dashboard.php?student_id= {$_SESSION['student_id']}'><span class='glyphicon glyphicon-book'></span> {$_SESSION['student_username']}</a></li>
				</ul>";
		} 


		else {
			echo "<ul class='nav navbar-nav pull-right'>
			<li><a href='../admin/login_form.php'><span class='glyphicon glyphicon-user'></span> Admin</a></li>
		</ul>";
		}

		?>

	</div>
</nav>
	
	<div class="container">
        <div class="row centered-form">
        <div class="col-md-12">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title text-center">Edit User</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" name="edit-form">
			    			
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

