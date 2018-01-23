<?php session_start(); ?>

<?php include '../inc/db.php';?>

<?php 

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}

?>

<?php

if (isset($_GET['q'])) { 
	$q = intval($_GET['q']);
} else{
	$q = 2;
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
					<a class="nav-link dropdown-toggle" href="./admin/login_form.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user'></span> <?php echo $username; ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="./logout.php">Logout</a>
					</div>
				</li> 
		</ul>
	</div>
</nav>

<!-- paste from here -->

<div class="container">
	
	
		<form >
			<div class="form-group">
				<select name="users" onchange="showUser(this.value)">
					<option value="">Select Per Page Records</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
	</form>
	

<div id="data"></div>



<script src="../js/main.js"></script>
<!-- <script>
	$( document ).ready(function showUser(str) {
		console.log(str);
		if (str=="") {
		document.getElementById("txtHint").innerHTML="";
		return;
		}
		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		} else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
		document.getElementById("txtHint").innerHTML=this.responseText;
		}
		}
		xmlhttp.open("GET","../admin/view.php?q=2",true);
		xmlhttp.send();
		});
</script> -->
</body>
</html>

