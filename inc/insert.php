


<?php

// $password = md5(123456);
// for($i=1; $i<=20; $i++){


// // function RandomString($length) {
// //     $keys = array_merge(range('a', 'z'), range('A', 'Z'));
// //     for($i=0; $i < $length; $i++) {
// //         $key .= $keys[array_rand($keys)];
// //     }
// //     return $key;
// // }

// // print RandomString(10);

// // 	exit;

// 	// $query = "INSERT INTO student_users (username, first_name, last_name, email, address, password, mobile, dob, gender, user_image, age) VALUES ('brij123', 'brij', 'yadav', 'brij123@gmail.com', 'Malad', '{$password}', '9167751696', '1995-01-08', 'Male', 'user', '22')";

// 	$query = "INSERT INTO test (name, email) VALUES ('brij', 'brij@123.com')";

// 	$register_user_query = mysqli_query($connection, $query);



// }


  $url = "https://maps.googleapis.com/maps/api/geocode/json?address=mumbai";

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

?>



