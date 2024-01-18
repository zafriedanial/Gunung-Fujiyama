
<?php

//this codes is for login process
//check userid & pwd is matched

$UserID = $_POST['userID']; 
$UserPwd = $_POST['userPwd'];

//declare DB connection variables

$host = "localhost";
$username = "root";
$password = ""; // please write password if any
$dbname = "listener";// please write your DB name that you have created

//create connections with DB
$link = new mysqli($host, $username, $password, $dbname);

if ($link->connect_error) { //to check if DB connection IS NOT OK
 die("Connection failed: " . $link->connect_error); // display MySQL error
}
else
{
	//connect successfully
	//check userID is exist
	
	$queryCheck = "select * from authorities where UserID = '".$UserID."' ";
	$resultCheck = $link->query($queryCheck);
	
	if ($resultCheck->num_rows == 0) {
		echo "<p style='color:red;'>User ID does not exists </p>";
		echo "<br>Click <a href='login.html'> here </a> to log-in again";
 }
 else
 {
		$row = $resultCheck->fetch_assoc();

		// check if password database = password user enter
		if( $row["UserPwd"] == $UserPwd )
		{
		//calling the session_start() is compulsory
		session_start();
		//asign userid & usertype value to session variable
		$_SESSION["UID"] = $UserID ;
		$_SESSION["UserType"] = $row["UserType"];

		//redirect to file menu.php upon successful login
	header("Location:menu.php");
	} else { //if password not matched

	echo "<p style='color:red;'>Wrong password!!! </p>";
	echo "Click <a href='login.html'> here </a> to login again ";
		}
	}
}
$link->close();
?>
