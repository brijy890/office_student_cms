<?php session_start(); ?>
<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sudent-CMS</title>
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>


 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Student-CMS</a>
      <a class="navbar-brand" href="../product/product-2.php">Product</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="/">Home</a></li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">

      	<?php 

		if (isset($_SESSION['username'])) {

				if($_SERVER['PHP_SELF'] == "/admin/dashboard.php" || $_SERVER['PHP_SELF'] == "/admin/dashboard-2.php" || $_SERVER['PHP_SELF'] == "/admin/dashboard-3.php" || $_SERVER['PHP_SELF'] == "/admin/detail_dashboard.php" || $_SERVER['PHP_SELF'] == "/admin/users_records.php" || $_SERVER['PHP_SELF'] == "/product/product-show.php"){
				echo "
				<ul class='nav navbar-nav pull-right'>
					<li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-user'></span> {$_SESSION['username']}
						</a>
					<ul class='dropdown-menu pull-right'>
						<li><a href='../admin/logout.php'>Logout <span class='glyphicon glyphicon-log-out'></span></a></li>
						<li class='divider'></li>

						<li><a href='#'>Profile <span class='glyphicon glyphicon-user'></span></a></li>
						<li class='divider'></li>

						<li><a href='../product/product-show.php'>Products <span class='glyphicon glyphicon-tag'></span></a></li>
						<li class='divider'></li>
					</ul>
					</li> 
				</ul>";
			} else{

				echo "
				<ul class='nav navbar-nav'>
					<li>
						<a href='./admin/dashboard.php'><span class='glyphicon glyphicon-user'></span> {$_SESSION['username']}
						</a>
					</li>
				</ul>";

			}

		} else if(isset($_SESSION['student_username'])){

			if (isset($_SESSION['student_image'])) {
					$image = $_SESSION['student_image'];
				}

			if ($_SERVER['PHP_SELF'] == "/student/dashboard.php" || $_SERVER['PHP_SELF'] == "/student/edit.php") {

				echo "
				<ul class='nav navbar-nav pull-right'>
					<li class='nav-item dropdown'>
						<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><span><img width='15' src='../images/$image'></span> {$_SESSION['student_username']}
						</a>
					<ul class='dropdown-menu pull-right'>
						<li><a href='../student/logout.php'>Logout <span class='glyphicon glyphicon-log-out'></span></a></li>
						<li class='divider'></li>
					</ul>
					</li> 
				</ul>";
			} else{

				echo "<ul class='nav navbar-nav pull-right'>
					<li><a href='./student/dashboard.php?student_id= {$_SESSION['student_id']}'><span><img width='15' src='../images/$image'></span> {$_SESSION['student_username']}</a></li>
				</ul>";

			}
		}

		else {
			echo " <li><a href='../admin/register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
			echo "<li><a href='../admin/login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
		}
		?>
      </ul>
    </div>
  </div>
</nav> 


