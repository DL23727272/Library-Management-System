<?php
include '../process/myConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['editUserID'];
    $fullName = $_POST['editFullName'];
    $username = $_POST['editUsername'];
    $department = $_POST['studentDepartment'];
    $password = $_POST['editPassword'];

    if (!empty($password)) {
        $passwordEncrypt = md5($password);
        $sql = "UPDATE users SET fullName='$fullName', username='$username', department='$department', password='$passwordEncrypt' WHERE idNumber='$userID'";
    } else {
        $sql = "UPDATE users SET fullName='$fullName', username='$username', department='$department' WHERE idNumber='$userID'";
    }

    if (mysqli_query($con, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
