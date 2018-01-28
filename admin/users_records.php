<?php include '../inc/header.php'; ?>

<?php 

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}

?>



		<?php

		$per_page = 2;

		if (isset($_GET['page'])) {
			$page = $_GET['page'];

		} else {

		$page = "1";
		}

		if ($page == "" || $page == 1) {
		$page_1 = 0;
		} else {
		$page_1 = ($page * $per_page) - $per_page;
		}

		$student_count_query = "SELECT * FROM admin";
		$student_query = mysqli_query($connection, $student_count_query);
		$count = mysqli_num_rows($student_query);

		$count = ceil($count / $per_page);

		?>

<div class="container">
  <h2 class="text-center">User Records</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>User ID</th>
        <th>Username</th>
        <th>User Role</th>
      </tr>
    </thead>
    <tbody>

		<?php
		
		$query = "SELECT * FROM admin LIMIT $page_1, $per_page";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {
		$user_id = $row['id'];
		$user_username	=	$row['username'];
		$user_role	=	$row['role'];
		echo '<tr>';
		echo "<td>{$user_id}</td>";
		echo "<td>{$user_username}</td>";
		if ($user_role === 'student') {
			echo "<td><a class='btn btn-default' href='./users_records.php?change_to_admin={$user_id}'>{$user_role}<a/></td>";
		}
		else{
			echo "<td><a class='btn btn-default' href='./users_records.php?change_to_student={$user_id}'>{$user_role}<a/></td>";
		}

	}
  ?>
    </tbody>
  </table>
  <a href="./dashboard.php" class="btn btn-default">Back</a>
</div>


<?php

if (isset($_GET['change_to_admin'])) {
	$id = $_GET['change_to_admin'];

	$query = "UPDATE admin SET role = 'admin' WHERE id = '{$id}' ";

    $change_to_sub_id_query = mysqli_query($connection, $query);

    if(!$change_to_sub_id_query){
        die("query failed".mysqli_error($connection));
        
    }else{
    	header("Location: users_records.php");
    }
}

if (isset($_GET['change_to_student'])) {
	$id = $_GET['change_to_student'];

	$query = "UPDATE admin SET role = 'student' WHERE id = '{$id}' ";

    $change_to_sub_id_query = mysqli_query($connection, $query);

    if(!$change_to_sub_id_query){
        die("query failed".mysqli_error($connection));
    } else{
    	header("Location: users_records.php");
    }
}




?>

<ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                     echo "<li><a class='active_link' href='users_records.php?page={$i}'>{$i}</a></li>";
                 } else{
                     echo "<li><a href='users_records.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>

</body>
</html>

