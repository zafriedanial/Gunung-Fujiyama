<?php
session_start();
//if session exists
//session userid gets value from text field named userid, shown in login.php
if(isset ($_SESSION["UID"]))  {
?>
<html>
<head>
<title>Listener Menu </title>
</head>
<body>
<h2> WELCOME, Hi <?php echo $_SESSION["UID"];?> </h2>
<p> Choose your menu : </p>

<?php
	if ($_SESSION["UserType"] == "Admin") {
	?>
	
	<a href = "ViewSong.php"> View Song List </a><br><br>
	<a href = "song_statusAdminEditView.php"> User List </a><br><br>
	<?php
	}
	else {
	?>
	<a href = "Song_Form.php"> Register New Song </a> <br><br>
	<a href = "Song_editView.php"> Edit Song Details </a><br><br>
	<a href = "Song_DeleteView.php"> Delete Song Record </a><br><br>
	<a href = "ViewSong.php"> View Song List </a><br><br>
	<?php
	}
	?>
<a href="logout.php">Logout</a><br>
</body>
</html>
<?php
}
else
{
	echo "No session exists or session has expired. Please log in again. <br>";
	echo "<a href='login.html'> Login </a>";
}
?>