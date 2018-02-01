<?php include '../inc/header.php';?>


<?php

if(isset($_POST['submit'])){
	$currency = $_POST['currency'];
}

if (empty($currency)) {
	$currency = 100;
}

$result = file_get_contents("https://api.fixer.io/latest?base=USD");
$result = json_decode($result, true);
$result = $result['rates'];


$usd = $result['INR'];

$result = number_format($currency/$usd, 2);

?>




	<div class="container">
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

		<div class="form-group">
		<input type="text"  placeholder="Enter value in INR" name="currency">
		</div>

		<input type="submit" value="submit" name="submit" class="btn btn-primary">

		</form>
		<br>
		<table class="table table-bordered">
		<th>INR</th>
		<th>USD</th>
		<tbody>
			<tr>
				<td><?php echo $currency;?></td>
				<td><?php echo $result;?></td>
			</tr>
		</tbody>
		</table>
	</div>
		
			
<?php

// $result = file_get_contents("https://api.fixer.io/latest?base=USD");
// $result = json_decode($result, true);
// $result = $result['rates'];

// foreach ($result as $key => $value) {

// 	echo "<tr>";
// 	echo "<td>$key</td>";
// 	echo "<td>$value</td>";
// 	echo "</tr>";

// }
?>



