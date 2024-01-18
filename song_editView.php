<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listener Song Edit View</title>
</head>

<body>
    <h2>SONG EDIT VIEW</h2>

    <p>Choose which record you want to update</p>

    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryView = "SELECT * FROM SONG where User_ID = '".$_SESSION["UID"]."'";
            $result = $conn->query($queryView);
        }
    ?>

    <form action="song_editDetails.php" method="post">

        <table border="2">
            <tr>
                <th>Choose</th>
                <th>Song ID</th>
                <th>Title</th>
                <th>Artist Name</th>
                <th>Link</th>
                <th>Genre</th>
                <th>Language</th>
                <th>Release Date</th>
                <th>User ID</th>
                <th>Status</th>
            </tr>

            <?php
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>
                        <tr>
                            <td> <input type="radio" name="Song_ID" value="<?php echo $row["Song_ID"]; ?>" required></td>
                            <td> <?php echo $row["Song_ID"];?></td>
                            <td> <?php echo $row["Song_Title"];?></td>
                            <td> <?php echo $row["Artist_Name"];?></td>
                            <td> <?php echo $row["Link"];?></td>
                            <td> <?php echo $row["Genre"];?></td>
                            <td> <?php echo $row["Language"];?></td>
                            <td> <?php echo $row["ReleaseDate"];?></td>
                            <td> <?php echo $row["User_ID"];?></td>
                            <td> <?php echo $row["Status"];?></td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><th colspan='10' style='color:red;'>No Data Selected</th></tr>";
                }

                $conn->close();
            ?>
        </table>

        <br><br>
        <input type="submit" value="View Record to Edit">
    </form>
</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>