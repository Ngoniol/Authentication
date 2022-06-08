<?php

$host ='localhost';
$user ='root';
$pass='';
$db='login';
$conn = new mysqli ($host,$user,$pass,$db);

$data = $_POST;

if (empty($data['Firstname']) ||
    empty($data['Surname']) ||
    empty($data['Gender']) ||
    empty($data['Email']) ||
    empty($data['Password']) ||
    empty($data['Password_confirm'])) {   
    die('Please fill all fields!');
}

if ($data['Password'] !== $data['Password_confirm']) {
   die('Password and Confirm password should match!');   
}

$Firstname= $_POST['Firstname'];
$Surname= $_POST['Surname'];
$Gender=$_POST['Gender'];
$Email =$_POST['Email'];
$Password=$_POST['Password'];

$sql = "INSERT INTO customers(Firstname,Surname,Gender,Email,Password) VALUES ('$Firstname','$Surname','$Gender','$Email', '$Password')";
if ( mysqli_query($conn, $sql)){
    header("Location:../login/");
}
else{
	echo "Failed to insert";
}
?>