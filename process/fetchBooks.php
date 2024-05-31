<?php

include '../process/myConnection.php';

$sql = "SELECT * FROM books_table";
$result = mysqli_query($con, $sql);

$productCount = 0;

echo '<div class="row justify-content-center m-2">';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="card mt-4 m-3 p-3 col-12 col-md-6 col-lg-3">';
    echo '<div class="d-flex justify-content-center">';
    echo '<img src="books/'. $row['bookImage'] .'" alt="Book Cover" style="max-width: 100%; height: 200px; object-fit: cover; filter: drop-shadow(5px 5px 15px #006341)"/>';
    echo '</div>';
    echo '<hr class="border-success border-2"/>';
    echo '<div>';
    echo '<h4 class="card-title" id="name'. $row['bookID'] .'">'. $row['bookTitle'] .'</h4>';
    echo '<p class="card-text text-secondary" id="bookAuthor">'. $row['bookAuthor'] .'</p>';
    echo '<p class="card-text text-secondary" id="bookISBN">'. $row['bookISBN'] .'</p>';
    echo '<p class="card-text text-secondary" id="bookStatus">'. $row['bookStatus'] .'</p>';
    echo '</div>';
    
    // Add to Cart button only if the book is available
    if ($row['bookStatus'] == 'Available') {
        echo '<button class="btn btn-primary add-to-cart" data-book-id="'. $row['bookID'] .'" data-book-title="'. $row['bookTitle'] .'" data-book-author="'. $row['bookAuthor'] .'" data-book-isbn="'. $row['bookISBN'] .'">Add to Cart</button>';
    }
    
    echo '</div>';

    $productCount++;

    if ($productCount % 3 == 0) {
        echo '</div>'; 
        echo '<div class="row justify-content-center m-2">'; 
    }
}

if ($productCount % 3 != 0) {
    echo '</div>';
}
?>
