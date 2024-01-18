<!-- song_statusSave.php -->

<?php
session_start();
if(isset($_SESSION["Admin"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Song_ID = $_POST["Song_ID"];
        $newStatus = $_POST["newStatus"];

       
        header("Location: song_statusAdminEditView.php?Song_ID=" . $Song_ID);
        exit();
    }
} else {
    echo "No session exists or session has expired. Please log in again.";
}
?>
