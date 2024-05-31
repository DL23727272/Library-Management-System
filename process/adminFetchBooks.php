<?php
include '../process/myConnection.php';

$sql = "SELECT * FROM books_table";
$result = mysqli_query($con, $sql);

$productCount = 0;

echo '<div id="booksContainer" class="row justify-content-center m-2">';

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
    echo '<button class="btn btn-secondary edit-book" 
            data-book-id="'. $row['bookID'] .'" 
            data-book-title="'. $row['bookTitle'] .'" 
            data-book-author="'. $row['bookAuthor'] .'" 
            data-book-isbn="'. $row['bookISBN'] .'" 
            data-book-status="'. $row['bookStatus'] .'" 
            data-book-image="'. $row['bookImage'] .'" 
            data-bs-toggle="modal" data-bs-target="#editBookModal'. $row['bookID'] .'">
            Edit
          </button>';
    echo '<button class="btn btn-danger delete-book mt-3" data-book-id="'. $row['bookID'] .'">Delete</button>';


    // Modal
    echo '<div class="modal fade" id="editBookModal'. $row['bookID'] .'" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">';
    echo '    <div class="modal-dialog modal-dialog-centered" role="document">';
    echo '        <div class="modal-content" style="background: rgba(255, 255, 255, 0.449); backdrop-filter: blur(10px);">';
    echo '            <div class="modal-header custom-modal">';
    echo '                <div class="col-sm">';
    echo '                    <img src="img/logo.png" alt="" style="width: 70px;">';
    echo '                </div>';
    echo '                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '            </div>';
    echo '            <div class="container align-items-center justify-content-center DL">';
    echo '                <div class="row">';
    echo '                    <div class="col-sm content">';
    echo '                        <div class="w-100"></div>';
    echo '                        <br>';
    echo '                        <div class="col-sm">';
    echo '                            <h1 class="font-weight-bold text-light" style="font-size: 20px;">Edit Book</h1>';
    echo '                        </div>';
    echo '                        <br>';
    echo '                        <form enctype="multipart/form-data" id="editBookForm' . $row['bookID'] . '" class="edit-book-form">';
    echo '                            <input type="hidden" name="editBookID" id="editBookID'. $row['bookID'] .'" value="'. $row['bookID'] .'">';
    echo '                            <div class="form-group my-2">';
    echo '                                <input type="text" name="editBookTitle" id="editBookTitle'. $row['bookID'] .'" placeholder="Enter Book Title" class="form-control" value="'. $row['bookTitle'] .'" required>';
    echo '                            </div>';
    echo '                            <div class="form-group my-2">';
    echo '                                <input type="text" name="editBookAuthor" id="editBookAuthor'. $row['bookID'] .'" placeholder="Enter Book Author" class="form-control" value="'. $row['bookAuthor'] .'" required>';
    echo '                            </div>';
    echo '                            <div class="form-group my-2">';
    echo '                                <input type="text" name="editBookISBN" id="editBookISBN'. $row['bookID'] .'" placeholder="Enter Book ISBN" class="form-control" value="'. $row['bookISBN'] .'" required>';
    echo '                            </div>';
    echo '                            <div class="form-group my-2">';
    echo '                                <select name="editBookStatus" id="editBookStatus'. $row['bookID'] .'" class="form-control" required>';
    echo '                                    <option value="" disabled>Select Status</option>';
    echo '                                    <option value="Available"'. ($row['bookStatus'] == 'Available' ? ' selected' : '') .'>Available</option>';
    echo '                                    <option value="Borrowed"'. ($row['bookStatus'] == 'Borrowed' ? ' selected' : '') .'>Borrowed</option>';
    echo '                                </select>';
    echo '                            </div>';
    echo '                            <div class="form-group my-2">';
    echo '                                <input type="file" name="image" id="editBookImage'. $row['bookID'] .'" class="form-control">';
    echo '                            </div>';
    echo '                            <div class="form-group row justify-content-end">';
    echo '                                <div class="col-auto">';
    echo '                                    <button type="submit" id="editBookButton'. $row['bookID'] .'" class="btn btn-outline-light">Save Changes</button>';
    echo '                                </div>';
    echo '                            </div>';
    echo '                        </form>';
    echo '                        <br>';
    echo '                        <br>';
    echo '                    </div>';
    echo '                </div>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
    
    echo '</div>';

    $productCount++;
    if ($productCount % 3 == 0) {
        echo '</div><div class="row justify-content-center m-2">';
    }
}

if ($productCount % 3 != 0) {
    echo '</div>';
}
?>
