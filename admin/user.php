
<?php include '../inc/db.php';?>

<?php
    
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $query = "SELECT * FROM student_users WHERE username = '{$username}' ";
    $select_user = mysqli_query($connection, $query);

    if (!$select_user) {
    die("QUERY FAILED ".mysqli_error($connection));
    } 

    $count = mysqli_num_rows($select_user);

    if ($count > 0) {

        while ($row = mysqli_fetch_assoc($select_user)) {
        echo json_encode($row);
        } 
    } else{
    echo json_encode(0);
    }
    exit;
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "SELECT * FROM student_users WHERE email = '{$email}' ";
    $select_user = mysqli_query($connection, $query);

    if (!$select_user) {
    die("QUERY FAILED ".mysqli_error($connection));
    } 

    $count = mysqli_num_rows($select_user);

    if ($count > 0) {

    while ($row = mysqli_fetch_assoc($select_user)) {
    echo json_encode($row, JSON_PRETTY_PRINT);
    } 
    } else{
    echo json_encode(0);
    }
    exit;
}

else{

    $query = "SELECT * FROM student_users";
    $select_user = mysqli_query($connection, $query);

    if (!$select_user) {
    die("QUERY FAILED ".mysqli_error($connection));
    } 

    $count = mysqli_num_rows($select_user);

    if ($count > 0) {

    while ($row = mysqli_fetch_assoc($select_user)) {
    echo json_encode($row, JSON_PRETTY_PRINT);
    } 
    } else{
    echo json_encode(0);
    }
}

?>




