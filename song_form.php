<!DOCTYPE HTML>
<?php
session_start();
if(isset($_SESSION["UID"])) {
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listener Song Registration Form</title>
</head>
<body>
    <h1><b>Song Registration Form</b></h1>
    <p><b>Enter song details:</b></p>
    <p><i style="color:red">* ALL fields are required</i></p>
    <form name="songRegisterForm" method="post" action="song_register.php">
        Song Title: <input type="text" id="Song_Title" name="Song_Title" maxlength="50" required> 
        <br><br>
        Artist/Band Name: <input type="text" id="Artist_Name" name="Artist_Name" maxlength="50" required>
        <br><br>
        Genre:
        <select id="Genre" name="Genre" required>
            <option value="" selected>-Please Choose-</option>
            <option value="Pop">Pop</option>
            <option value="Rock">Rock</option>
			<option value="K-Pop">K-Pop</option>
			<option value="EDM">EDM</option>
            <option value="Hip Hop">Hip Hop</option>
        </select>              
        <br><br>
        Link: <input type="url" id="Link" name="Link" required>
        <br><br>
        Language: <input type="text" id="Language" name="Language" maxlength="20" required>
        <br><br>
        Release Date: <input type="date" id="ReleaseDate" name="ReleaseDate" required>
        <br><br>
      
        <input type="submit" value="Display Song Details">
        <input type="reset" value="Cancel">
    </form>
    
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