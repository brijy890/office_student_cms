<?php include '../inc/header.php';?>


<?php

$per_page = 7;

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

// $student_count_query = "SELECT * FROM student_users";
// $student_query = mysqli_query($connection, $student_count_query);
// $row_count = mysqli_num_rows($student_query);

$query = "SELECT COUNT(*) as count FROM product";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
  $row_count = $row['count'];
}

$count = ceil($row_count / $per_page);
?>


<?php

if ($row_count <= 0) {
  echo "<h1 class='text-center'>No records</h1>";
} else{
  ?>


<div class="container">
<h2 class="text-center">Products</h2>      
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>PID</th>
        <th>Name</th>
        <th>Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

		<?php
		
		$query = "SELECT * FROM product LIMIT $page_1, $per_page";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
		die("QUERY FAILED ".mysqli_error($connection));
		} 

		while ($row = mysqli_fetch_assoc($select_user)) {

    $pid       = $row['id'];
    $pname     = $row['pname'];
    $pimage    = $row['pimage'];
		echo '<tr>';
		echo "<td>{$pid}</td>";
		echo "<td>{$pname}</td>";
    echo "<td><img src='../images/products/250x250/$pimage' width=50 height=50></td>";
		echo "<td><a href='../product/product-edit.php?pid=$pid' class='btn btn-primary btn-block'>Edit</a></td>";
    echo "</tr>";

	}
  ?>
    </tbody>
  </table>


  <ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                	// $page = $i;
                     echo "<li><a class='active_link' href='dashboard.php?page={$i}'>{$i}</a></li>";
                 } else{
                	// $page = $i;
                     echo "<li><a href='dashboard.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>
</div>

<?php } ;?>

<?php include '../inc/footer.php';?>
