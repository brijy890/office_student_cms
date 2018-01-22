<?php session_start(); ?>

<?php include '../inc/db.php';?>

<?php 

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
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
					<a class="nav-link dropdown-toggle" href="./admin/login_form.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class='glyphicon glyphicon-user'> <?php echo $username; ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="./logout.php">Logout</a>
					</div>
				</li> 
		</ul>
	</div>
</nav>

<!-- paste from here -->

<div class="container">
	<form>
		<select name="users" onchange="showUser(this.value)">
			<option value="">Select Per Page Records</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</form>
</div>

<div id="txtHint"></div>

<script src="../js/main.js"></script>
<script>
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
</script>
</body>
</html>

