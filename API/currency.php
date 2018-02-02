<?php include '../inc/header.php';?>


<?php


if(isset($_POST['submit'])){
	$currency = $_POST['currency'];
	$base     = $_POST['base'];
}

if (empty($base)) {
	$base = 'USD';
}

if (empty($currency)) {
	$currency = 100;
}


$result = file_get_contents("https://api.fixer.io/latest?base=".$base);

$result = json_decode($result, TRUE);

$result = $result['rates'];

$usd = $result['INR'];

$result = number_format($currency/$usd, 2);

?>




	<div class="container">
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

		<div class="form-group">
			<input type="text"  placeholder="Enter Base" name="base" class="form-control">
		</div>

		<div class="form-group">
			<input type="text"  placeholder="Enter value in INR" name="currency" class="form-control">
		</div>

		<input type="submit" value="submit" name="submit" class="btn btn-primary btn-block">

		</form>
		<br>
		<table class="table table-bordered">
		<th>Currency</th>
		<th>Value</th>
		<tbody>
			<tr>
				<td>INR</td>
				<td><?php echo $currency;?></td>
			</tr>

			<tr>
				<td><?php echo $base;?></td>
				<td><?php echo $result;?></td>
			</tr>
		</tbody>
		</table>
	</div>
		
			




