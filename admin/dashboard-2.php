

<?php include '../inc/db.php';?>

<?php include '../inc/header.php';?>

<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>

<?php

$per_page = 2;

$count = "SELECT COUNT(id) FROM student_users";
$count = mysqli_query($connection, $count);
$count = mysqli_fetch_row($count);
$count = $count[0];

$count = ceil($count / $per_page);

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

<form>
<select name="users" id="perPage">
<option value="">Select per page</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</form>

<div id="target"></div>

  <ul class="pager" id="pagination">


            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                	// $page = $i;
                     echo "<li  id='{$i}'><a  href='dashboard-2.php?page={$i}'>{$i}</a></li>";
                 } else{
                	// $page = $i;
                     echo "<li id='{$i}'><a href='dashboard-2.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>

  </ul>
</div>

<script type="text/javascript">
	

	$(document).ready(function(){

		$.ajax({
				type: "post",
				url: "../admin/pagination.php?page=1&q=3",
				dataType: "html",                 
				success: function(data) {
				$("#target").html(data);
				}

			});

	});

	$("#pagination li").click(function(e){
			e.preventDefault();
			var pageNum = this.id;
			var perPage = $("#perPage").val();

			if (perPage == '') {
				perPage = 3;
			}
			console.log(pageNum);
			console.log(perPage);
			var active = $("a#pageNum");
			console.log(active);
			$.ajax({
				type: "post",
				url: "../admin/pagination.php?page="+pageNum+"&q="+perPage,
				dataType: "html",                 
				success: function(data) {

				$("#target").html(data);
				}

			});
		});

	$("#perPage").change(function(){
		var perPage = $("#perPage").val();
		console.log(perPage);

		$.ajax({
				type: "post",
				url: "../admin/pagination.php?q="+perPage+"&page=1",
				dataType: "html",                 
				success: function(data) {

				$("#target").html(data);
				}

			});


	});
	


</script>

</body>
</html>
