<?php include '../inc/student.php'; ?>

<?php 

// Redirect function
function redirect($location){
	global $connection;
	return header("Location:". $location);
}

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

	// global $connection;
	// $query		= "INSERT INTO admin (username, password, role) VALUES ('{$username}', '{$password}', '{$role}')";
	// $register_admin_query = mysqli_query($connection, $query);

	// confirmedQuery($register_admin_query);

	// redirect('../');

	$admin = new Admin($username, $password, $role);
	// $admin->setAdmin($username, $password, $role);
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




function make_thumb($src, $dest, $desired_width) {

	
	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}





/**
*
* Function Name: cwUpload()
* $field_name => Input file field name.
* $target_folder => Folder path where the image will be uploaded.
* $file_name => Custom thumbnail image name. Leave blank for default image name.
* $thumb => TRUE for create thumbnail. FALSE for only upload image.
* $thumb_folder => Folder path where the thumbnail will be stored.
* $thumb_width => Thumbnail width.
* $thumb_height => Thumbnail height.
*
**/
function mmake_thumb_2($field_name, $target_folder, $file_name, $thumb = TRUE, $thumb_folder, $thumb_width, $thumb_height){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
        	
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);

                    echo $source;
                    exit;
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}


function delete_image($image_name){

			echo $image_name;

			unlink("../images/products/original/".$image_name);
			unlink("../images/products/250x250/".$image_name);
			unlink("../images/products/300x300/".$image_name);
			unlink("../images/products/650x500/".$image_name);
}