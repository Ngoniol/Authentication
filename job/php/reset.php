<?php
//connection to database
$host ='localhost';
$user ='root';
$pass='';
$db='login';
$conn = new mysqli ($host,$user,$pass,$db);

$email=$_POST['Email'];

//start new session
session_start();

// select the record that matches this email
$sql = "SELECT * FROM customers WHERE Email = '$email'";
$query  = mysqli_query($conn, $sql);

// rows returned should be one
$count = mysqli_num_rows($query);

$rows = '';

if ($count == 1){

	// convert result to associative array format
	if ($rows = mysqli_fetch_assoc($query)){
        if($_POST["Password"] ==  $_POST["newpassword"]) {
            mysqli_query($conn,"UPDATE customers set Password='" . $_POST["newpassword"] . "' WHERE Email='" . $email . "'");
            header("Location: ../login/");
} else{
 echo "<script>alert('Password don't match')</script>"
}
}
}
?>