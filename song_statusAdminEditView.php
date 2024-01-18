<?php 
session_start(); 
//check if session exists 
if(isset($_SESSION["UID"])) { 
?>

<!DOCTYPE html>
<html>
<head>
<title> Listener Page </title>
</head>

<body>
<h2> Listener Song List </h2>
<br>

<form action="song_statusAdminEdit.php" method="POST" onsubmit="return confirm('Are you sure to edit this record?')">
<table border="1">
<tr>
	<th> Choose </th>
	<th> Song ID </th>
	<th> Title </th>
	<th> Artist/BandName </th>
	<th> Link </th>
	<th> Genre </th>
	<th> Language </th>
	<th> ReleaseDate </th>
	<th> UserID </th>
	<th> Status </th>
</tr>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "listener";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error){
	die("connection failed:" . $conn->connect_error);
}else {
	$queryView = "SELECT *FROM SONG" ;
	$resultView = $conn->query($queryView);
	
	if ($resultView->num_rows >0) {
		while($row = $resultView->fetch_assoc()){
?>

	<tr>
		<td> <input type="radio" name="Song_ID" value="<?php echo $row["Song_ID"]; ?>" required> </td>
		<td> <?php echo $row["Song_ID"]; ?> </td>
		<td> <?php echo $row["Song_Title"]; ?> </td>
		<td> <?php echo $row["Artist_Name"]; ?> </td>
		<td> <?php echo $row["Link"]; ?> </td>
		<td> <?php echo $row["Genre"]; ?> </td>
		<td> <?php echo $row["Language"]; ?> </td>
		<td> <?php echo $row["ReleaseDate"]; ?> </td>
		<td> <?php echo $row["User_ID"]; ?> </td>
		<td> <?php echo $row["Status"]; ?> </td>
	</tr>
<?php
		}
	} else {
		echo "<tr><th colspan='10' style='color:red;'>No Data Selected</td></tr>";
	}
}
$conn->close();
?>
</table>
<br>
<input type="submit" value="View record to Edit">
</form>
<button onclick="window.location.href='menu.php'">Menu</button>
</body>
</html>

<?php 
} 
else 
{ 
echo "No session exists or session has expired. Please 
log in again.<br>"; 
echo "<a href=login.html> Login </a>"; 
} 
?>
		