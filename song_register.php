<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listener - Song Registration Details</title>
</head>

<?php
    $Song_Title = $_POST["Song_Title"];
    $Artist_Name = $_POST["Artist_Name"];
    $Link = $_POST["Link"];
    $Genre = $_POST["Genre"];
    $Language = $_POST["Language"];
    $ReleaseDate = $_POST["ReleaseDate"];
  // $Status = $_POST["Status"]; 
?>

<body>
    <h1>Song Registration Details</h1>
    <br>
    <table border="1">
        <tr>
            <td>Song Title:</td>
            <td><b style="color: blue;"><?php echo $Song_Title; ?></b></td>
        </tr>
        <tr>
            <td>Artist/Band Name:</td>
            <td><b><?php echo $Artist_Name; ?></b></td>
        </tr>
        <tr>
            <td>Link:</td>
            <td><b><?php echo $Link; ?></b></td>
        </tr>
        <tr>
            <td>Genre:</td>
            <td><b><?php echo $Genre; ?></b></td>
        </tr>
        <tr>
            <td>Language:</td>
            <td><b><?php echo $Language; ?></b></td>
        </tr>
        <tr>
            <td>Release Date:</td>
            <td><b><?php echo $ReleaseDate; ?></b></td>
        </tr>
        
    </table>

    <?php
 
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        } else {
            $dbquery = "INSERT INTO SONG (Song_Title, Artist_Name, Link, Genre, Language, ReleaseDate, User_ID, Status)
                        VALUES ('$Song_Title', '$Artist_Name', '$Link', '$Genre', '$Language', '$ReleaseDate', '".$_SESSION["UID"]."', 'pending')";
            
            if ($conn->query($dbquery) === TRUE) {
                echo "<p style='color: blue;'>Success insert song data</p>";
            } else {
                echo "<p style='color: red;'>Error: Invalid query ".$conn->error."</p>";
            }
        }

        $conn->close();
    ?>

    <br><br>
    <p>Click <a href="song_form.php" target="_self">here</a> to enter a new song.<br>
    Click <a href="ViewSong.php" target="_self">here</a> to view all songs.

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>