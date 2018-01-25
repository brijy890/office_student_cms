

<?php include '../inc/db.php';?>

<?php include '../inc/header.php';?>

<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>

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

<div class="container">

<div id="target"></div>

</div>

<script type="text/javascript">
	

	$(document).ready(function(){

		$.ajax({
				type: "post",
				url: "../admin/pagination-3.php?page=1&q=3",
				dataType: "html",                 
				success: function(data) {
				$("#target").html(data);
				}

			});

	});
	


</script>

</body>
</html>
