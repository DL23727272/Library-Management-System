<?php
include "../process/myConnection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postData = file_get_contents("php://input");

    $requestData = json_decode($postData, true);

    $studentID = $requestData['studentID'];
    $studentName = $requestData['studentName'];
    $books = $requestData['books'];

    $success = insertBorrowedBooks($studentID, $studentName, $books);

    if ($success) {
        $bookIDs = array_column($books, 'id');
        updateBookStatus($bookIDs);
    }

    // Prepare response data
    $response = [
        'success' => $success
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}

// Function to insert borrowed books into the database
function insertBorrowedBooks($studentID, $studentName, $books)
{
    global $con;
    foreach ($books as $book) {
        $title = $book['title'];
        $author = $book['author'];
        $isbn = $book['isbn'];
        $sql = "INSERT INTO borrowed_books (student_id, student_name, book_title, book_author, book_isbn) VALUES ('$studentID', '$studentName', '$title', '$author', '$isbn')";
        if ($con->query($sql) !== true) {
            return false; 
        }
    }
    return true;
}

// Function to update book status to 'Borrowed' after borrowing
function updateBookStatus($bookIDs)
{
    global $con;
    foreach ($bookIDs as $bookID) {
        $sql = "UPDATE books_table SET bookStatus = 'Borrowed' WHERE bookID = $bookID";
        if ($con->query($sql) !== true) {
            return false; 
        }
    }
    return true;
}

?>
