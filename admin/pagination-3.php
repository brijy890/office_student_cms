
<?php include '../inc/db.php';?>

<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>


<?php

if (isset($_GET['q'])) {
	$q = $_GET['q'];
} 

// $per_page = 3;

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

// $student_count_query = "SELECT * FROM student_users";
// $student_query = mysqli_query($connection, $student_count_query);
// $count = mysqli_num_rows($student_query);

// $count = ceil($count / $per_page);

// $per_page = 2;

$count = "SELECT COUNT(id) FROM student_users";
$count = mysqli_query($connection, $count);
$count = mysqli_fetch_row($count);
$count = $count[0];

$count = ceil($count / $per_page);

?>

<div class="container">

<form>
<select name="users" id="perPage">
<?php

if (isset($_GET['q'])) {
	echo "<option value='$q' selected>{$q}</option>";
	for($i=1; $i<=5; $i++){

		if($i != $q){
			echo "<option value='$i'>{$i}</option>";
		}
		
	}
} else{
	echo "<option value=''>Select per page</option>";
	for($i=1; $i<=5; $i++){
			echo "<option value='$i'>{$i}</option>";
	}
}
?>
<!-- <option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option> -->
</select>
</form>

<h2 class="text-center">Students Records</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>Student ID</th>
        <th>Username</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

		<?php
		
		$query = "SELECT * FROM student_users LIMIT $page_1, $per_page";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$student_id 		= $row['id'];
		$student_username 	= $row['username'];
		$student_email 		= $row['email'];
		$student_first_name = $row['first_name'];
		$student_last_name 	= $row['last_name'];
		$student_mobile 	= $row['mobile'];
		$student_address 	= $row['address'];
		echo '<tr>';
		echo "<td>{$student_id}</td>";
		echo "<td>{$student_username}</td>";
		echo "<td><a href='./detail_dashboard.php?s_id=$student_id&page=$page' class='btn btn-primary btn-block'>View</a></td>";
    echo "</tr>";

	}
  ?>
    </tbody>
  </table>

  <a href="./users_records.php" class="btn btn-default">View Users</a>


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

  <?php include '../inc/footer.php';?>

  <script type="text/javascript">

  		$("#pagination li").click(function(e){
			e.preventDefault();
			pageNum = this.id;
			var perPage = $("#perPage").val();

			console.log("Page No" + "="+pageNum);
			console.log("Per Page" + "="+perPage);

			$.ajax({
				type: "post",
				url: "../admin/pagination-3.php?page="+pageNum+"&q="+perPage,
				dataType: "html",                 
				success: function(data) {

				$("#target").html(data);
				$("li#"+pageNum+" a").addClass('active_link');
				}

			});
		});


  	var pageNum;
	$("#pagination li").click(function(e){
		e.preventDefault();
		pageNum = this.id;
	});


	$("#perPage").change(function(){
		var perPage = $("#perPage").val();
		// var pageNum = $("#pagination li").val();
		// $("#pagination li").click(function(e){
		// 	e.preventDefault();
		// 	pageNum = this.id;
		// });

		if (!pageNum) {
			pageNum = 1;
		}


		
		

		console.log("Page No" + "="+pageNum);
		console.log("Per Page" + "="+perPage);

		$.ajax({
				type: "post",
				url: "../admin/pagination-3.php?q="+perPage+"&page="+pageNum,
				dataType: "html",                 
				success: function(data) {

				$("#target").html(data);
				$("li#"+pageNum+" a").addClass('active_link');
				}

			});



	});
  </script>