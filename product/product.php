<?php include '../inc/header.php';?>


<?php

$per_page = 12;

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

	<div class="container">
		<div class="container product-section">
			<div class="row text-center">

				<?php

				$query = "SELECT * FROM product LIMIT $page_1, $per_page";
				$execute_equery = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_assoc($execute_equery)) {
				$pid 	= $row['id'];
				$pimage = $row['pimage'];
				$pname  = $row['pname'];
				$pdesc  = $row['pdesc'];



				echo "
						<div class='col-md-4'>
							<div class='card'>
							<div class='card-header'><h2 class='product-name'>$pname</h2></div>
							<div class='card-body'>
							<a href='../product/productDetails.php?pid=$pid'><img class='card-img-top' src='../images/products/250x250/$pimage' alt='Card image cap'></a>
							<p class='card-text'>$pdesc</p>
							
							</div>
							</div>
						</div>";

				}
				?>
			</div>
		</div>

	<ul class="pager">

            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                     echo "<li><a class='active_link' href='product.php?page={$i}'>{$i}</a></li>";
                 } else{
                     echo "<li><a href='product.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>
  </ul>
	

	</div>
<?php include '../inc/footer.php';?>
<script>
	
	$(function(){
		$(".card-img-top").hover(function(){
			$(this).toggleClass( "hover" );
		});
	});
</script>