<?php include '../inc/header.php';?>


<?php

//step1
$cSession = curl_init(); 
//step2
curl_setopt($cSession,CURLOPT_URL,"https://api.fixer.io/latest?base=USD");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
//step3
$result=curl_exec($cSession);
//step4
curl_close($cSession);
//step5
echo $result;

exit;

if (isset($_POST['submit'])) {
	
	echo $currency = $_POST['currency'];
}




?>


	<div class="container">
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

			<div class="form-group">
				<input type="text"  placeholder="Enter value in INR" name="currency">
			</div>

			<input type="submit" value="submit" name="submit" class="btn btn-primary">
			
		</form>
	</div>

