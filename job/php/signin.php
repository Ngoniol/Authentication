<?php
//connection to database
$host ='localhost';
$user ='root';
$pass='';
$db='login';
$conn = new mysqli ($host,$user,$pass,$db);

//start new session
session_start();

//code
if (isset($_POST['Email']) && isset($_POST['Password'])){

	$email = $_REQUEST['Email'];

	$password = $_REQUEST['Password'];

// select the record that matches this email
$sql = "SELECT * FROM customers WHERE Email = '$email'";
$query  = mysqli_query($conn, $sql);

// rows returned should be one
$count = mysqli_num_rows($query);

$rows = '';

if ($count == 1){

	// convert result to associative array format
	if ($rows = mysqli_fetch_assoc($query)){
		
		// grab id
		$id = $rows['CustomerID'];

		// grab email
		$email = $rows['Email'];

		// compare password
		if ($password == $rows['Password']){

			// set new session variable with the grabbed id
			$_SESSION['loggedin_customer'] = true;
			$_SESSION['Firstname'] = $rows['Firstname'];
			$_SESSION['Surname'] = $rows['Surname'];
			$_SESSION['Gender'] = $rows['Gender'];
			$_SESSION['CustomerID'] = $id;
			$_SESSION['Email'] = $email;

			// redirect the logged in user to their dashboard
			header("Location: ../dashboard/");
		}
		else{
			echo"<script>alert('Wrong password')</script>".mysqli_error($conn);
		}
	}
}  
// else if we never found 1 row with a matching email, there is an error
else{
echo "<script>alert('Invalid email')</script>".mysqli_error($conn);
}

}

?>