<?php session_start(); ?>
<?php include './inc/db.php';?>
<?php include './inc/header.php';?>


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
			<li><a href='./admin/login_form.php'><span class='glyphicon glyphicon-user'></span> Admin</a></li>
		</ul>";
		}

		?>


	</div>
</nav>

		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron text-center">
				<h1 class="display-6">Welcome Student</h1>
				<p class="lead">This is Student CMS system</p>
				<hr class="my-4">
				<p></p>
				<p class="lead">


				<!-- <a class="btn btn-info btn-lg" href="./student/register_form.php" role="button">Register</a> -->
				

				<?php

				if (isset($_SESSION['student_username'])) {
					echo "<a class='btn btn-info btn-lg' href='./student/dashboard.php?student_id= {$_SESSION['student_id']}' role='button'>Register</a>";

				} else if(isset($_SESSION['username'])){
					echo "<a class='btn btn-info btn-lg' href='./admin/dashboard.php' role='button'>Register</a>";

				} else{
					echo "<a class='btn btn-info btn-lg' href='./student/register_form.php' role='button'>Register</a>";
				}



				?>




				<?php

				if (isset($_SESSION['student_username'])) {
					echo "<a class='btn btn-info btn-lg' href='./student/dashboard.php?student_id= {$_SESSION['student_id']}'' role='button'>Login</a>";
				} else if(isset($_SESSION['username'])){
					echo "<a class='btn btn-info btn-lg' href='./admin/dashboard.php' role='button'>Login</a>";
				} else{
					echo "<a class='btn btn-info btn-lg' href='./student/login_form.php' role='button'>Login</a>";
				}


				?>

				</p>
				</div>
			</div>
		</div>
		
<?php include './inc/footer.php';?>