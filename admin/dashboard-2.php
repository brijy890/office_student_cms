
<?php include '../inc/header.php';?>

<?php
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>

<?php

$per_page = 4;

$count = "SELECT COUNT(id) FROM student_users";
$count = mysqli_query($connection, $count);
$count = mysqli_fetch_row($count);
$count = $count[0];

$count = ceil($count / $per_page);

?>

<div class="container">

<div id="target"></div>

  <ul class="pager" id="pagination">


            <?php

            for ($i=1; $i <=$count ; $i++) {

                if ($i == $page) {
                	// $page = $i;
                     echo "<li  id='{$i}'><a  class='active_link' href='dashboard-2.php?page={$i}'>{$i}</a></li>";
                 } else{
                	// $page = $i;
                     echo "<li id='{$i}'><a href='dashboard-2.php?page={$i}'>{$i}</a></li>";
                 }  
            }
            ?>

  </ul>
</div>

<?php include '../inc/footer.php';?>
