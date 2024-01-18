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

<form action = "song_statusSave.php" method = "POST" onsubmit = "return confirm('Are you sure to edit this record?')">
<table border="1">
<tr>
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
$Song_ID = $_POST["Song_ID"];
$host = "localhost";
$user = "root";
$pass = "";
$db = "listener";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error){
	die("connection failed:" . $conn->connect_error);
}else {
	$queryView = "SELECT *FROM SONG WHERE Song_ID = '".$Song_ID."'";
	$resultView = $conn->query($queryView);
	
	if ($resultView->num_rows >0) {
		while($row = $resultView->fetch_assoc()){
?>

	<tr>
		<td> <?php echo $row["Song_ID"]; ?> </td>
		<td> <?php echo $row["Song_Title"]; ?> </td>
		<td> <?php echo $row["Artist_Name"]; ?> </td>
		<td> <?php echo $row["Link"]; ?> </td>
		<td> <?php echo $row["Genre"]; ?> </td>
		<td> <?php echo $row["Language"]; ?> </td>
		<td> <?php echo $row["ReleaseDate"]; ?> </td>
		<td> <?php echo $row["User_ID"]; ?> </td>
		<td> 
             <select name = "Status" id = "Status";>
                <option value = "Approved" <?php echo ($row["Status"] == "Approved") ? "selected" : ""; ?>> Approved </option> 
                <option value = "Rejected" <?php echo ($row["Status"] == "Rejected") ? "selected" : ""; ?>> Rejected </option>
            </select>
        </td>
    <input type = "hidden" name = "id" value = "<?php echo $row["Song_ID"]; ?>">
	</tr>

<?php
		}
	} else {
		echo "<tr><th colspan='8' style='color:red;'>No Data Selected</td></tr>";
	}
}
$conn->close();
?>
</table>
<br><br>
<input type="submit" value="Update New Details">
</form>
<br>
</body>
</html>
<?php
}
else
{
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>