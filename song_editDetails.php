
<?php
session_start();
// check if session exists
if(isset($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listener Song Edit Details</title>
</head>

<body>
    <h2>SONG EDIT DETAILS</h2>

    <p style="color: blue; font-weight: bold;">Update Song details</p>

    <?php
        $Song_ID = $_POST["Song_ID"];

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "listener";

        $conn = new mysqli($host, $user, $pass, $db);

        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $queryGet = "SELECT * FROM SONG WHERE Song_ID = '".$Song_ID."' ";
            $resultGet = $conn->query($queryGet);

            if ($resultGet->num_rows > 0) {
    ?>
                <form action="Song_editSave.php" name="UpdateForm" method="POST">

    <?php
                while($row = $resultGet->fetch_assoc()) {
    ?>

                    Song ID: <b><?php echo $row["Song_ID"]; ?></b>
                    Title: <input type="text" name="Song_Title" value="<?php echo $row["Song_Title"]; ?>" maxlength="50" size="35" required><br><br>
                    Artist/Band Name: <input type="text" name="Artist_Name" value="<?php echo $row["Artist_Name"]; ?>" maxlength="50" size="35" required><br><br>
                    Genre: 
                    <?php $Genre = $row["Genre"]; ?>
                    <select name="Genre" required>
                        <option value=""> - Please choose - </option>
                        <option value="Pop" <?php if ($Genre == "Pop") echo "selected"; ?>> Pop </option>
                        <option value="Rock" <?php if ($Genre == "Rock") echo "selected"; ?>> Rock </option>
                        <option value="Hip Hop" <?php if ($Genre == "Hip Hop") echo "selected"; ?>> Hip Hop </option>
                        <!-- Add more genres as needed -->
                    </select>
                    <br><br>
                    Link: <input type="url" name="Link" value="<?php echo $row["Link"]; ?>" maxlength="20" size="50" required><br><br>
                    Language: <input type="text" name="Language" value="<?php echo $row["Language"]; ?>" maxlength="20" size="35" required><br><br>
                    Release Date: <input type="date" name="ReleaseDate" value="<?php echo $row["ReleaseDate"]; ?>" required><br><br>
                    Status: <input type="text" name="Status" value="<?php echo $row["Status"]; ?>" maxlength="20" size="35" required><br><br>

                    <br><br>
                    <input type="hidden" name="Song_ID" value="<?php echo $row["Song_ID"]; ?>">
                    <input type="submit" value="Update New Details">
                </form>

    <?php
                }
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