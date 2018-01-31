<?php include '../inc/header.php';?>

<?php $params = pagination_prams('product');?>

<?php

if ($params['row_count'] <= 0) {
  echo "<h1 class='text-center'>No records</h1>";
  echo "<a href='../product/productUpload.php' class='text-center btn btn-default'>Add Product</a>";
} else{
  
?>

<div class="container">
  <a href="../product/productUpload.php" class="btn btn-default">Add Product</a>
  <h2 class="text-center">Products</h2>      
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
        	<th>PID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

  		<?php
  		
  		$query = "SELECT * FROM product LIMIT {$params['page_1']}, {$params['per_page']}";
  		$select_user = mysqli_query($connection, $query);

  		confirmedQuery($select_user);

  		while ($row = mysqli_fetch_assoc($select_user)) {

      $pid       = $row['id'];
      $pname     = $row['pname'];
      $pimage    = $row['pimage'];
      $price     = $row['price'];

  		echo '<tr>';
  		echo "<td>{$pid}</td>";
  		echo "<td>{$pname}</td>";
      echo "<td><img src='../images/products/250x250/$pimage' width=50 height=50></td>";
      echo "<td>{$price}</td>";
  		echo "<td><a href='../product/product-edit.php?pid=$pid' class='btn btn-primary btn-block'>Edit</a></td>";
      echo "</tr>";

  	}
    ?>
     </tbody>
    </table>


    <ul class="pager">
      <?php getPager($params['count'], $params['page'], '../product/product-show.php');?>
    </ul>
</div>

<?php } ;?>

<?php include '../inc/footer.php';?>
