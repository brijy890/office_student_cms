<?php include './inc/header.php';?>

<div id="data">

<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron text-center">
				<h1 class="display-6">Welcome Student</h1>
				<p class="lead">This is Student CMS system</p>
				<hr class="my-4">
				<p></p>
				<p class="lead">
				

				<?php

				if (isset($_SESSION['student_username'])) {
					echo "<a class='btn btn-info btn-lg' href='./student/dashboard.php?student_id= {$_SESSION['student_id']}' role='button'>Register</a>";

				} else if(isset($_SESSION['username'])){
					echo "<a class='btn btn-info btn-lg' href='./admin/dashboard.php' role='button'>Register</a>";

				} else{
					echo "<a class='btn btn-info btn-lg' href='./student/register.php' id='register'  role='button'>Register</a>";
				}

				?>

				<?php

				if (isset($_SESSION['student_username'])) {
					echo "<a class='btn btn-info btn-lg' href='./student/dashboard.php?student_id= {$_SESSION['student_id']}'' role='button'>Login</a>";
				} else if(isset($_SESSION['username'])){
					echo "<a class='btn btn-info btn-lg' href='./admin/dashboard.php' role='button'>Login</a>";
				} else{
					echo "<a class='btn btn-info btn-lg'  href='./student/login.php' id='login' role='button'>Login</a>";
				}


				?>

				</p>
				</div>
			</div>
		</div>
</div>

</div>

<!-- <script>
	
	$( document ).ready(function() {

     var login = $("#login");
     login.click(function(){

     		$.ajax({
			type: "get",
			url: "../student/login.php",
			dataType: "html",                 
			success: function(data) {
			$("#data").html(data);
			}

		});
     });


     var register = $("#register");
     register.click(function(){

     		$.ajax({
			type: "get",
			url: "../student/register.php",
			dataType: "html",                 
			success: function(data) {
			console.log(data);
			$("#data").html(data);
			}
		});
 
     });
});

</script> -->
		
<?php include './inc/footer.php';?>