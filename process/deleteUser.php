<?php
include '../process/myConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['userID'];

    $sql = "DELETE FROM users WHERE idNumber='$userID'";

    if (mysqli_query($con, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
