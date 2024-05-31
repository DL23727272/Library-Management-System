<?php
include '../process/myConnection.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookID = $_POST['editBookID'];
    $bookTitle = $_POST['editBookTitle'];
    $bookAuthor = $_POST['editBookAuthor'];
    $bookISBN = $_POST['editBookISBN'];
    $bookStatus = $_POST['editBookStatus'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Retrieve image information
        $image = $_FILES['image']['name']; 
        $extension = explode('.',$image); 
        $rand = rand(10000,99999);
        $newImageName = $extension[0].$rand.'.'.$extension[1];
        $uploadPath = "../books\\" . $newImageName;

        $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);

        if ($isUploaded) {
            $sql = "UPDATE books_table SET 
                bookTitle = '$bookTitle', 
                bookAuthor = '$bookAuthor', 
                bookISBN = '$bookISBN', 
                bookStatus = '$bookStatus',
                bookImage = '$newImageName'
                WHERE bookID = '$bookID'";

            if (mysqli_query($con, $sql)) {
                $response['success'] = true;
                $response['message'] = "Book updated successfully with new image";
            } else {
                $response['success'] = false;
                $response['message'] = "Error updating book: " . mysqli_error($con);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error uploading image";
        }
    } else {
        $sql = "UPDATE books_table SET 
                bookTitle = '$bookTitle', 
                bookAuthor = '$bookAuthor', 
                bookISBN = '$bookISBN', 
                bookStatus = '$bookStatus'
                WHERE bookID = '$bookID'";

        if (mysqli_query($con, $sql)) {
            $response['success'] = true;
            $response['message'] = "Book updated successfully without changing the image";
        } else {
            $response['success'] = false;
            $response['message'] = "Error updating book: " . mysqli_error($con);
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request";
}

echo json_encode($response);


?>
