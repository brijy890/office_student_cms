<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>
<?php checkConnection();?>

<?php studentLogin();?>

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
					<li><a href='./student/dashboard.php?student_id= {$_SESSION['student_id']}'><span class='glyphicon glyphicon-book'></span> {$_SESSION['student_username']}</a></li>
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
			    		<h3 class="panel-title text-center">Student Login</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			    			

			    			<div class="form-group">
			    				<input type="text" name="username" id="username" class="form-control input-sm" placeholder="Username" required>
			    			</div>


			    			<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
	    					</div>
			    			
			    			<input type="submit" value="Login" class="btn btn-info btn-block" name='login'>
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

</body>
</html>