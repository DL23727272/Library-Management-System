<?php
include '../process/myConnection.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookID'])) {
    $bookID = $_POST['bookID'];

    $sql = "DELETE FROM books_table WHERE bookID = '$bookID'";

    if (mysqli_query($con, $sql)) {
        $response['success'] = true;
        $response['message'] = "Book deleted successfully";
    } else {
        $response['success'] = false;
        $response['message'] = "Error deleting book: " . mysqli_error($con);
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request";
}

echo json_encode($response);
?>
