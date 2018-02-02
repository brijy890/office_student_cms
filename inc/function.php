<?php include '../inc/student.php'; ?>
<?php include '../oops/query.php';?>

<?php 

// Redirect function
function redirect($location){
	global $connection;
	return header("Location: {$location}");
}

// To check query excuted successfully or not
function confirmedQuery($query){

	global $connection;
	if(!$query){
		die("Query Failed".mysqli_error($connection, $query));
	}
}

//student registration
function studentResgister($username, $first_name, $last_name, $email, $mobile, $address, $dob, $gender, $password, $user_image, $age){
	global $connection;

	$query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile, dob, gender, user_image, age) VALUES ('{$username}', '{$first_name}', '{$last_name}', '{$email}', '{$address}', '{$password}', '{$mobile}', '{$dob}', '{$gender}', '{$user_image}', '{$age}')";

	$register_user_query = mysqli_query($connection, $query);

	confirmedQuery($register_user_query);

	redirect("../student/login.php");
}

// student login function
function studentLogin(){

	global $connection;
	$student = new Student();
	if(isset($_POST['login'])){
	$login_username = $_POST['username'];
	$login_password = md5($_POST['password']);
	$student->studentLogin($login_username, $login_password);
	}
}

// admin registration
function adminRegister($username, $password, $role){

	$admin = new Admin($username, $password, $role);
	$admin->registerAdmin();
}


//admin login function
function adminLogin(){

	global $connection;
	if(isset($_POST['login'])){
		
		$login_username = trim($_POST['username']);
		$login_password = trim($_POST['password']);

		$login_password = md5($login_password);

		$query = "SELECT * FROM admin WHERE username = '{$login_username}' ";
		$select_user = mysqli_query($connection, $query);

		if (!$select_user) {
			confirmedQuery($select_user);
		}	

		while ($row = mysqli_fetch_assoc($select_user)) {
			$db_username	= $row['username'];
			$db_password 	= $row['password'];
			$db_role 		= $row['role'];

		}

		
		if ($db_role === 'admin') {

				if($db_username == $login_username && $db_password == $login_password){

				$_SESSION['username'] 	= $db_username;
				$_SESSION['password'] 	= $db_password;

				redirect("./dashboard.php");
				// header("Location:". 'dashboard.php');
			} else {
				redirect("../index.php");
				// header("Location:". 'index.php');
				
			}
		} else{
			if (admin_exits($db_username)) {
				redirect("../");
			}else{
				redirect("../admin/register.php");
			}
		}
		
	}
}

//admin exits
function admin_exits($username){

	global $connection;
	$query = "SELECT * FROM admin WHERE username = '{$username}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}

}



function checkConnection(){
	global $connection;
	
	if (!$connection) {
	header("Location:". "../");
}
}

function user_exits($username){

	global $connection;
	$query = "SELECT * FROM student_users WHERE username = '{$username}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

function email_exits($email){

	global $connection;
	$query = "SELECT * FROM student_users WHERE email = '{$email}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

function mobile_exits($mobile){

	global $connection;
	$query = "SELECT * FROM student_users WHERE mobile = '{$mobile}' ";
	$select_query = mysqli_query($connection, $query);

	if (!$select_query) {
		confirmedQuery($select_query);
	}

	$count = mysqli_num_rows($select_query);

	if ($count > 0) {
		return true;
	} else{
		return false;
	}
}

function usernameValidate($username){

	global $connection;
	$message = '';
	if ($username == '') {
		$message = 'username cannot be empty';
	} else{
		if (strlen($username) < 5)
		{
			$message =	'username should have more then 5 charachter';
		} else{
			if (user_exits($username)) 
			{
				$message	=	"Username exits, <a href='login.php' class='btn btn-primary'>Login</a>";
			}
		}
	}
	return $message;
}

function firstnameValidate($first_name){

	global $connection;
	$message = '';
	if ($first_name == '') {
		$message = 'Firstname cannot be empty';
	} else{
			if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) 
			{
				$message = "Only letters and white space allowed";
			}
	}
	return $message;
}

function lirstnameValidate($last_name){

	global $connection;
	$message = '';
	if ($last_name == '') {
		$message = 'Lastname cannot be empty';
	} else{
			if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) 
			{
				$message = "Only letters and white space allowed";
			}
	}
	return $message;
}


function emailValidate($email){

	global $connection;
	$message = '';
	if ($email == '') {
		$message			=	'Email cannot be empty';
		} else{
		if (email_exits($email)) {
			$message		=	'This email id already exits';
		}
	}
	return $message;
}

function mobileValidate($mobile){

	global $connection;
	$message = '';

	if ($mobile == '') {
		$message		=	'Mobile number cannot be empty';
	} else{
		if ((strlen($mobile)) != 10) {
			$message	=	'Mobile number should be of 10 digits';
		} else {
			if (mobile_exits($mobile)) {
				$message	=	'This mobile no already exits';
			}
		}
	}
	return $message;
}

function addressValidate($address){

	global $connection;
	$message = '';

	if ($address == '') {
		$message		=	'Address cannot be empty';
	}
	return $message;
}

function genderValidate($gender){

	global $connection;
	$message = '';

	if ($gender == ''){
		$message =	'Gender cannot be empty';
	}
	return $message;
}

function dobValidate($dob){

	global $connection;
	$message = '';

	if ($dob == '') {
		$message		=	'DOB cannot be empty';
	}
	return $message;
}


function  passwordValidate($password, $confirm_password){

	global $connection;
	$message = '';

	if ($password == '') {
		$message	=	'Password cannot be empty';
	} else{
		if ($password != $confirm_password) {
			$message = 'Password and confirm password does not matched';
		}
	}
	return $message;
}



// Delete old image after update
function delete_image($image_name){

	unlink("../images/products/original/".$image_name);
	unlink("../images/products/250x250/".$image_name);
	unlink("../images/products/300x300/".$image_name);
	unlink("../images/products/650x500/".$image_name);
}



// Upload product
function upload_product(){

	global $connection;

	if(isset($_POST['uplaod'])){

	$pname	= trim($_POST['pname']);
	$pdesc 	= trim($_POST['pdesc']);
	$price  = trim($_POST['price']);

	if(isset($_FILES['pimage'])){
		
		$errors = array('file_ext' => '', 'file_size' => '' );
		$file_name 	= $_FILES['pimage']['name'];

		if ($file_name == '') {
			$file_name = 'placeholder-image.png';

			$file_type = 'image/png';
			
			genarate_thumbnails($file_name, $file_type);

			upload_query($pname, $pdesc, $file_name, $price);

			header("Location: ../product/product-show.php");


		} else{

		$file_size 	= $_FILES['pimage']['size'];
		$file_tmp 	= $_FILES['pimage']['tmp_name'];
		$file_type	= $_FILES['pimage']['type'];
		$file_ext	= strtolower(end(explode('.',$_FILES['pimage']['name'])));

		$expensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$expensions) === false){
			$errors['file_ext'] = "extension not allowed, please choose a JPEG or PNG file.";
		}

		if($file_size > 2097152){
			$errors['file_size'] = 'File size must be excately 2 MB';
		}

		foreach ($errors as $key => $value) {

			if (empty($value)) {
				unset($errors[$key]);
			}
		}


		if(empty($errors)==true){

			$file_name = uniqid();
			$file_name = $file_name . "." . $file_ext;

			move_uploaded_file($file_tmp,"../images/products/original/".$file_name);
			
			genarate_thumbnails($file_name, $file_type);

			upload_query($pname, $pdesc, $file_name, $price);

			header("Location: ../product/product-show.php");			
		} else{
			return $errors;
		}
	}
}
}
}


 // Get Product Data to show on edit form
function get_product_data(){
    
    global $connection;
	if (isset($_GET['pid'])) {
	    $pid = $_GET['pid'];
	}

	$col 	= array();
	$params = array('id' => $pid);
	$db_result = selectQuery('product', $col, $params);

	// $query = "SELECT * FROM product WHERE id = '{$pid}'";
	// $query = mysqli_query($connection, $query);
	// confirmedQuery($query);
	// while ($row = mysqli_fetch_assoc($query)) {
	// 	$db_pname 		= $row['pname'];
	// 	$db_pdesc 		= $row['pdesc'];
	// 	$db_pimage 		= $row['pimage'];
	// 	$db_price 		= $row['price'];
	// }

	return $product_data = array(
		'pid' => $db_result['id'], 'db_pname' => $db_result['pname'], 'db_pdesc' => $db_result['pdesc'], 'db_pimage' => $db_result['pimage'], 'db_price' => $db_result['price']);
}



// Edit product
function edit_product($pid, $db_pimage){
	global $connection;
	if(isset($_POST['edit'])){

	$pname	= trim($_POST['pname']);
	$pdesc 	= trim($_POST['pdesc']);
	$price  = trim($_POST['price']);

	if(isset($_FILES['pimage'])){

		$errors = array('file_ext' => '', 'file_size' => '' );
		$file_name 	= $_FILES['pimage']['name'];

		if (empty($file_name)) {
			$file_name = $db_pimage;

			$col = array('pname' => $pname, 'pdesc' => $pdesc, 'pimage' => $file_name, 'price' => $price);
			$query = new Query();
			$query->updateQuery('product', $pid, $col);

			if ($db_pimage = 'placeholder-image.png') {
				redirect('../product/product-show.php');
			} else{
				delete_image($db_pimage);
				redirect('../product/product-show.php');
			}

		} else{

		$file_size 	= $_FILES['pimage']['size'];
		$file_tmp 	= $_FILES['pimage']['tmp_name'];
		$file_type	= $_FILES['pimage']['type'];
		$file_ext	= strtolower(end(explode('.',$_FILES['pimage']['name'])));

		$expensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$expensions)=== false){
			$errors['file_ext']="extension not allowed, please choose a JPEG or PNG file.";
		}

		if($file_size > 2097152){
			$errors['file_size']='File size must be excately 2 MB';
		}

		foreach ($errors as $key => $value) {
        
	        if (empty($value)) {

	            unset($errors[$key]);
	        } 
        }

		if(empty($errors)==true){

			$file_name = uniqid();
			$file_name = $file_name . "." . $file_ext;

			move_uploaded_file($file_tmp,"../images/products/original/".$file_name);
			
			genarate_thumbnails($file_name, $file_type);

			$col = array('pname' => $pname, 'pdesc' => $pdesc, 'pimage' => $file_name, 'price' => $price);
			$query = new Query();
			$query->updateQuery('product', $pid, $col);

			if ($db_pimage == 'placeholder-image.png') {
				redirect('../product/product-show.php');
			} else{
				delete_image($db_pimage);
				header("Location: ../product/product-show.php");

			}
		} else{
			return $errors;
		}
	}
}
}
}



function genarate_thumbnails($file_name, $file_type){

		global $connection;
		make_thumb('../images/products/original/'.$file_name, '../images/products/250x250/'.$file_name, 250, $file_type);
		make_thumb('../images/products/original/'.$file_name, '../images/products/300x300/'.$file_name, 300, $file_type);
		make_thumb('../images/products/original/'.$file_name, '../images/products/650x500/'.$file_name, 650, $file_type);
}


function make_thumb($src, $dest, $desired_width, $file_type) {

	
	/* read the source image */

	if ($file_type == 'image/jpeg') {
		$source_image 	= imagecreatefromjpeg($src);
	} else if($file_type == 'image/png'){
		$source_image 	= imagecreatefrompng($src);
	}

	$width 			= imagesx($source_image);
	$height 		= imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}


// product upload query
function upload_query($pname, $pdesc, $file_name, $price){

	$col = array('pname' => $pname, 'pdesc' => $pdesc, 'pimage' => $file_name, 'price' => $price);
	$query = new Query();
	$query->insertQuery('product', $col);
}



// Get pagination
function getPager($count, $page, $url){

	global $connection;

	for ($i=1; $i <=$count ; $i++) {

		if ($i == $page) {
			echo "<li><a class='active_link' href={$url}?page={$i}'>{$i}</a></li>";
		} else{
			echo "<li><a href={$url}?page={$i}'>{$i}</a></li>";
		}  
	}
}


// Count no of records in database
function count_query($tbl_name){
	global $connection;
	$query = "SELECT COUNT(*) as count FROM $tbl_name";
	$result = mysqli_query($connection, $query);
	confirmedQuery($result);
	while ($row = mysqli_fetch_assoc($result)) {
  		$row_count = $row['count'];
	}

	return $row_count;
}



// Pagination
function pagination_prams($tbl_name){

	global $connection;

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

	$row_count = count_query($tbl_name);

	$count = ceil($row_count / $per_page);

	return $params = array('per_page' => $per_page, 'page_1' => $page_1, 'row_count' => $row_count, 'count' => $count, 'page' => $page);
}



// function insertQuery($table_name, $col){

// 	global $connection;

// 	$last_key 	= end(array_keys($col));
// 	$last_value = end(array_values($col));

// 	$query = "INSERT INTO {$table_name} (";
// 	foreach ($col as $key => $value) {
// 		if($last_key == $key)
// 		{
// 			$query .= "{$key}";
// 		} else{
// 			$query .= "{$key}, ";
// 		}	
// 	}
// 	$query .= ") ";
// 	$query .= "VALUES (";
// 	foreach ($col as $key => $value) {
// 		if($last_value == $value){
// 			$query .= " '$value'";
// 		} else{
// 			$query .= " '$value',";
// 		}
// 	}
// 	$query .= ");";

// 	$query_execute = mysqli_query($connection, $query);

// 	if(!$query_execute){
// 		die(mysqli_error($connection));
// 	}
// }


// function updateQuery($table_name, $pid, $col){

// 	global $connection;

// 	$last_key 	= end(array_keys($col));

// 	$query = "UPDATE {$table_name} SET ";
// 	foreach ($col as $key => $value) {
// 		if($last_key == $key){
// 			$query .= "$key = '$value' ";
// 		} else{
// 			$query .= "$key = '$value', ";
// 		}
// 	}

// 	$query .= "WHERE id = $pid";

// 	$query_execute = mysqli_query($connection, $query);

// 	if(!$query_execute){
// 		die(mysqli_error($connection));
// 	}
// }

function selectQuery($table_name, $col, $params){

	global $connection;

	// print_r($col);
	// print_r($params);
	// echo $table_name;

	if (empty($col) && empty($params)) {
		$query = "SELECT * FROM {$table_name}";
	}

	if (empty($col)) {
		foreach ($params as $key => $value) {
				$query = "SELECT * FROM {$table_name} WHERE $key = '$value' ";
		}
	
	}

	if (empty($params)) {
		foreach ($col as $key => $value) {
			$query = "SELECT {$key} FROM {$table_name}";
		}
	}

	if (isset($col) && isset($params)) {
		foreach ($col as $col_key => $col_value) {
			foreach ($params as $params_key => $params_value) {
				$query = "SELECT {$col_key} FROM {$table_name} WHERE $params_key = $params_value";
			}
		}
	}

	$query = mysqli_query($connection, $query);
	confirmedQuery($query);

	 while ($row = mysqli_fetch_assoc($query)) {
		$result = $row;
	}

	return $result;

}





function getApi(){

	global $connection;

	if(isset($_POST['submit'])){
		$currency = $_POST['currency'];
		$base     = $_POST['base'];
		$address  = $_POST['address'];
	}

	if (empty($address)) {
		$address = 'india';
	}

	$geo_code = getGeocode($address);


	if (empty($base)) {
	$base = 'USD';
	}

	if (empty($currency)) {
	$currency = 100;
	}

	$url = "https://api.fixer.io/latest?base=".$base;

	$curl = curl_init();

	curl_setopt_array($curl, array(

	CURLOPT_URL => $url,

	CURLOPT_RETURNTRANSFER => true,

	CURLOPT_ENCODING => "",

	CURLOPT_MAXREDIRS => 10,

	CURLOPT_TIMEOUT => 30,

	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

	CURLOPT_CUSTOMREQUEST => "GET",

	CURLOPT_POSTFIELDS => "",

	CURLOPT_HTTPHEADER => array(

	"accept: application/json",

	"cache-control: no-cache",

	"content-type: application/json"

	),

	));



	$response = curl_exec($curl);

	$err = curl_error($curl);

	curl_close($curl);



	if ($err) {

	echo "cURL Error #:" . $err;

	} else {


	$response = json_decode($response);

	$INR = $response->rates->INR;

	$result = number_format(($currency/$INR), 2);

	}

	return $data = array('currency' => $currency, 'result' => $result, 'base' => $base, 'geo_code' => $geo_code);
}


function getGeocode($address){

  global $connection;


  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address;

  $curl = curl_init();

  curl_setopt_array($curl, array(

  CURLOPT_URL => $url,

  CURLOPT_RETURNTRANSFER => true,

  CURLOPT_ENCODING => "",

  CURLOPT_MAXREDIRS => 10,

  CURLOPT_TIMEOUT => 30,

  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_CUSTOMREQUEST => "GET",

  CURLOPT_POSTFIELDS => "",

  CURLOPT_HTTPHEADER => array(

  "accept: application/json",

  "cache-control: no-cache",

  "content-type: application/json"

  ),

  ));



  $response = curl_exec($curl);

  $err = curl_error($curl);

  curl_close($curl);



  if ($err) {

  echo "cURL Error #:" . $err;

  } else {

$response = json_decode($response);

$lat = $response->results[0]->geometry->location->lat;
$lag = $response->results[0]->geometry->location->lng;

  }

  return $geo_code = array('lat' => $lat, 'lag' => $lag);

}

?>

