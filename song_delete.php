<html>
<head>
    <title>Listener Song Delete</title>
</head>

<?php
session_start();
if(isset($_SESSION["UID"])) {
    $Song_ID = $_POST["Song_ID"];
?>

<body>
    <h2>SONG DELETE</h2>

    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        } else {
            $queryDelete = "DELETE FROM SONG WHERE Song_ID = '".$Song_ID."' ";

            if ($conn->query($queryDelete) === TRUE) {
                echo "<p style='color:blue';>Record has been deleted from the database!</p>";
                echo "Click <a href='ViewSong.php'>here</a> to view the song list.";
            } else {
                echo "<p style='color:red;'>Query problems! : " . $conn->error . "</p>";
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