<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listener - View Songs</title>
</head>

<body>
    <h2>SONG LIST</h2>
	
	<div class="filter">
	
	</div>

    <?php
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryView = "SELECT * FROM SONG ORDER BY ReleaseDate Desc";
            $result = $conn->query($queryView);
        }
    ?>

    <table border="2">
        <tr>
            <th>Song ID</th>
            <th>Title</th>
            <th>Artist/Band Name</th>
            <th>Link</th>
            <th>Genre</th>
            <th>Language</th>
            <th>Release Date</th>
            <th>Status</th>
        </tr>

        <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo $row["Song_ID"]; ?></td>
            <td><?php echo $row["Song_Title"]; ?></td>
            <td><?php echo $row["Artist_Name"]; ?></td>
            <td><?php echo $row["Link"]; ?></td>
            <td><?php echo $row["Genre"]; ?></td>
            <td><?php echo $row["Language"]; ?></td>
            <td><?php echo $row["ReleaseDate"]; ?></td>
            <td><?php echo $row["Status"]; ?></td>
        </tr>

        <?php
                }
            } else {
                echo "<tr><td colspan='8'>No data selected</td></tr>";
            }
        ?>

    </table>

    <br>
    Click <a href="song_form.php" target="_self">here</a> to enter new song details.
    <br><br>
    Click <a href="Song_deleteView.php">here</a> to delete song details.
    <br><br>
    Click <a href="song_editView.php" target="_self">here</a> to edit song list.
    <br><br>
    Click <a href="menu.php">here</a> to go back to the Menu page.

</body>
</html>

<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>