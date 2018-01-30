<?php include '../inc/db.php';?>
<?php include '../inc/function.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/product.css">
</head>
<body>

<header>
	<div class="header">
		<a href="../index-2.php"><h2 class="site-name">Product</h2></a>
	</div>
</header>

<?php

$per_page = 5;

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
confirmedQuery($result);
while ($row = mysqli_fetch_assoc($result)) {
  $row_count = $row['count'];
}

$count = ceil($row_count / $per_page);
?>


<?php 

if ($row_count <= 0) {
	echo "<h1 class='text-center'>No record</h1>";
} else{

	?>

		<div class="grid-container outline">
    	<ul class='product-list'>


        <?php

                $query = "SELECT * FROM product LIMIT $page_1, $per_page";
                $execute_equery = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($execute_equery)) {
                $pid    = $row['id'];
                $pimage = $row['pimage'];
                $pname  = $row['pname'];
                $pdesc  = $row['pdesc'];
                $price	= $row['price'];

                echo "<li>
          							<a href='../product/productDetails-2.php?pid=$pid'>
          								<img src='../images/products/250x250/$pimage' alt='$pname'>
          							</a>
          							<p>$pname</p><span>Price: $price<span>
          						</li>";
              }
        ?>
      </ul>
    </div>
	

<ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                     echo "<li><a class='active_link' href='product-2.php?page={$i}'>{$i}</a></li>";
                 } else{
                     echo "<li><a href='product-2.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>

	<?php } ?>

</body>
</html>

