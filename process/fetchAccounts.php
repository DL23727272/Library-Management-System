<?php
include '../process/myConnection.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);
$userCount = 0;
echo '<div id="usersContainer" class="row justify-content-center m-2">';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="card mt-4 m-3 p-3 col-12 col-md-6 col-lg-3">';
    echo '<hr class="border-success border-2"/>';
    echo '<div>';
    echo '<h4 class="card-title" id="name'. $row['idNumber'] .'">'. $row['fullName'] .'</h4>';
    echo '<p class="card-text text-secondary" id="userName">'. $row['username'] .'</p>';
    echo '<p class="card-text text-secondary" id="userDepartment">'. $row['department'] .'</p>';
    echo '</div>';
    echo '<button class="btn btn-secondary edit-user" 
            data-user-id="'. $row['idNumber'] .'" 
            data-full-name="'. $row['fullName'] .'" 
            data-username="'. $row['username'] .'" 
            data-department="'. $row['department'] .'" 
            data-bs-toggle="modal" data-bs-target="#editUserModal'. $row['idNumber'] .'">
            Edit
          </button>';

     // Modal
     echo '<div class="modal fade" id="editUserModal'. $row['idNumber'] .'" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">';
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
     echo '                            <h1 class="font-weight-bold text-light" style="font-size: 20px;">Edit User</h1>';
     echo '                        </div>';
     echo '                        <br>';
     echo '                        <form enctype="multipart/form-data" id="editUserForm' . $row['idNumber'] . '" class="edit-user-form">';
     echo '                            <input type="hidden" name="editUserID" id="editUserID'. $row['idNumber'] .'" value="'. $row['idNumber'] .'">';
     echo '                            <div class="form-group my-2">';
     echo '                                <input type="text" name="editFullName" id="editFullName'. $row['idNumber'] .'" placeholder="Enter Full Name" class="form-control" value="'. $row['fullName'] .'" required>';
     echo '                            </div>';
     echo '                            <div class="form-group my-2">';
     echo '                                <input type="text" name="editUsername" id="editUsername'. $row['idNumber'] .'" placeholder="Enter Username" class="form-control" value="'. $row['username'] .'" required>';
     echo '                            </div>';
     echo '                            <div class="form-group my-4">';
     echo '                                <label for="Department" style="font-weight: 700;" class="form-label">Department</label>';
     echo '                                <select class="form-control" id="studentDepartment'. $row['idNumber'] .'" name="studentDepartment" required>';
     echo '                                    <option value="">---Select Department---</option>';
     echo '                                    <option value="CCS" '. ($row['department'] == 'CCS' ? 'selected' : '') .'>College of Computing Studies</option>';
     echo '                                    <option value="CTE" '. ($row['department'] == 'CTE' ? 'selected' : '') .'>College of Teacher Education</option>';
     echo '                                    <option value="CAFED" '. ($row['department'] == 'CAFED' ? 'selected' : '') .'>College of Agriculture, Forestry, Engineering</option>';
     echo '                                    <option value="CBME" '. ($row['department'] == 'CBME' ? 'selected' : '') .'>College of Business, Management and Entrepreneurship</option>';
     echo '                                    <option value="LHS" '. ($row['department'] == 'LHS' ? 'selected' : '') .'>Laboratory High School</option>';
     echo '                                </select>';
     echo '                            </div>';
     echo '                            <div class="form-group my-2">';
     echo '                                <input type="password" name="editPassword" id="editPassword'. $row['idNumber'] .'" placeholder="Enter New Password" class="form-control">';
     echo '                            </div>';
     echo '                            <div class="form-group row justify-content-end">';
     echo '                                <div class="col-auto">';
     echo '                                    <button type="submit" id="editUserButton'. $row['idNumber'] .'" class="btn btn-outline-light">Save Changes</button>';
     echo '                                </div>';
     echo '                                <div class="col-auto">';
     echo '                                    <button class="btn btn-danger delete-user" data-user-id="'. $row['idNumber'] .'">Delete</button>';
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

    $userCount++;

    if ($userCount % 3 == 0) {
        echo '</div><div class="row justify-content-center m-2">';
    }
}

if ($userCount % 3 != 0) {
    echo '</div>';
}
?>
