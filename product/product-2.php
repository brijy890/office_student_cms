<?php include '../inc/db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product List</title>
	<link rel="stylesheet" href="../css/product.css">
</head>
<body>

<?php

$per_page = 4;

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

<!-- 	<div class="container">
		<div class="row">
			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nec leo lacus. Duis tincidunt faucibus rhoncus.</p>
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

		</div>

		<div class="row">
			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

			<div class="col-3">
				<img src="../images/products/250x250/pexels-photo-90946.jpeg" alt="">
			</div>

		</div>
	</div> -->


<div class="grid-container outline">
   
    <!-- <div class="row"> -->


        <?php

                $query = "SELECT * FROM product LIMIT $page_1, $per_page";
                $execute_equery = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($execute_equery)) {
                $pid    = $row['id'];
                $pimage = $row['pimage'];
                $pname  = $row['pname'];
                $pdesc  = $row['pdesc'];

                echo "

					<ul class='product-list'>
						<li>
							<a href='#'>
								<img src='../images/products/250x250/$pimage' alt='$pname'>
							</a>
							<p>$pname</p>
						</li>
					</ul>


                ";



                // echo "
                //     <div class='col-2 text-center'>
                //     <img src='../images/products/250x250/$pimage' alt='$pname'>
                //     <p>$pname</p>
                //     </div> ";

                    }
        ?>
    <!-- </div>  -->
</div>
	

<ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                	// $page = $i;
                     echo "<li><a class='active_link' href='product-2.php?page={$i}'>{$i}</a></li>";
                 } else{
                	// $page = $i;
                     echo "<li><a href='product-2.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>

</body>
</html>

