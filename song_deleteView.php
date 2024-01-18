<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listener Song Delete View</title>
</head>

<body>
    <h2>SONG DELETE VIEW</h2>

    <form action="song_delete.php" method="POST" onsubmit="return confirm('Are you sure to delete this record')">
        <table border="2">
            <tr>
                <th> Song ID </th>
                <th> Song Title </th>
                <th> Artist/Band Name</th>
                <th> Link </th>
                <th> Genre </th>
                <th> Language </th>
                <th> Release Date </th>
                <th> User ID </th>
                <th> Status </th>
            </tr>

            <?php
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "listener";

                $conn = new mysqli($host, $user, $pass, $db);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $queryView = "SELECT * FROM SONG WHERE User_ID = '".$_SESSION["UID"]."'";
                    $result = $conn->query($queryView);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
            ?>

                            <tr>
                                <td> <input type="radio" name="Song_ID" value="<?php echo $row["Song_ID"]; ?>" required></td>
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
                        echo "<tr><th colspan='9' style='color:red;'>No Data Selected</th></tr>";
                    }
                }
                $conn->close();
            ?>
        </table>
        <br>
        <input type="submit" value="Delete Selected Song">
    </form>
</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>