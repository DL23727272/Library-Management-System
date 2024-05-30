<?php
include "../process/myConnection.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the raw POST data
    $postData = file_get_contents("php://input");

    // Decode the JSON data into a PHP associative array
    $requestData = json_decode($postData, true);

    // Extract student information and books from the request data
    $studentID = $requestData['studentID'];
    $studentName = $requestData['studentName'];
    $books = $requestData['books'];

    // Insert borrowed books into the database
    $success = insertBorrowedBooks($studentID, $studentName, $books);

    if ($success) {
        // Update the status of borrowed books to 'unavailable'
        $bookIDs = array_column($books, 'id');
        updateBookStatus($bookIDs);
    }

    // Prepare response data
    $response = [
        'success' => $success
    ];

    // Encode response data as JSON and send it back to the client
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
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
            return false; // Return false if insertion fails
        }
    }
    return true;
}

// Function to update book status to 'unavailable' after borrowing
function updateBookStatus($bookIDs)
{
    global $con;
    $bookIDsStr = implode(', ', $bookIDs);
    $sql = "UPDATE book_table SET bookStatus = 'unavailable' WHERE bookID IN ($bookIDsStr)";
    $con->query($sql);
}

?>
