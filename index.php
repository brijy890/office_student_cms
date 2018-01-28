
<?php include '../inc/db.php';?>
<?php

if (isset($_POST['Login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$password = md5($password);

	$query = "SELECT * FROM admin WHERE username = '{$username}' AND password = '{$password}' ";

	$query_count = mysqli_query($connection, $query);

	header("Location: index-2.php");
	

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sudent-CMS</title>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

<style type="text/css">

	body{
		background: url("../images/pexels-photo-802959(1).jpeg") center center no-repeat;
	}

	.panel-default{
		display: none;
	}
</style>
</head>
<body>

<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title text-center">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<input class="btn btn-lg btn-info btn-block" type="submit" value="Login" name="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
	
	$(function(){

			$(".panel-default").fadeIn(4000);
		
	});
</script>

</body>
</html>









