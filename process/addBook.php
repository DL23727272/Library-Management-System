<?php

include '../process/myConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $bookTitle = $_POST['bookTitle'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookISBN = $_POST['bookISBN'];
    $bookStatus = $_POST['bookStatus'];
    
    $image = $_FILES['image']['name']; 
    $extension = explode('.',$image); 
    $rand = rand(10000,99999);
    $newImageName = $extension[0].$rand.'.'.$extension[1];
    $uploadPath = "..\books\\" . $newImageName;
    $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);


    if ($isUploaded) {
        $sql = "INSERT INTO books_table (bookTitle, bookAuthor, bookISBN, bookStatus, bookImage ) 
                VALUES ('$bookTitle', '$bookAuthor', '$bookISBN', '$bookStatus', '$newImageName' )";
        
        $query = mysqli_query($con, $sql);

        if ($query === true) {
            echo "Book inserted successfully";
        } else {
            echo "Error inserting product: " . mysqli_error($con);
        }
    } else {
        echo "File upload failed";
    }
} else {
    echo "Invalid request method";
}
