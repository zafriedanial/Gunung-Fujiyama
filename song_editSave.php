<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listener Song Edit Save</title>
</head>

<body>
    <h3>SONG UPDATE SAVE</h3>

    <?php
        $Song_ID = $_POST["Song_ID"];
        $Song_Title = $_POST["Song_Title"];
        $Artist_Name = $_POST["Artist_Name"];
        $Genre = $_POST["Genre"];
        $Link = $_POST["Link"];
        $Language = $_POST["Language"];
        $ReleaseDate = $_POST["ReleaseDate"];
        $Status = $_POST["Status"];
        
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryUpdate = "UPDATE SONG SET
                Song_Title = '".$Song_Title."', Artist_Name = '".$Artist_Name."',
                Genre = '".$Genre."', Link = '".$Link."',
                Language = '".$Language."', ReleaseDate = '".$ReleaseDate."',
                Status = '".$Status."'
                WHERE Song_ID = '".$Song_ID."' ";

            if($conn->query($queryUpdate) === TRUE) {
                echo "Success update data";
                echo "<br><br>";
                echo "Click <a href='ViewSong.php'>here</a> to view song list ";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        $conn->close();
    ?>

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>