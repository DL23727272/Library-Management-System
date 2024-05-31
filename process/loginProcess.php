<?php
include "../process/myConnection.php";

    if (isset($_POST['studentLoginName']) && isset($_POST['studentLoginPassword'])) {
        $username = $_POST["studentLoginName"];
        $password = $_POST["studentLoginPassword"];


        if ($username == "" || $password == "") {
            $response = [
                'status' => 'error',
                'message' => 'Empty fields! Please fill all the fields.'
            ];
        } else {

            $hashedPassword = md5($password);

            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Verify hashed password
                if ($hashedPassword === $row['password']) {
                    $studentID = $row['idNumber'];
                    $studentName = $row['fullName'];
                    $userType = $row['type'];
                    // Passwords match, login successful
                    $response = [
                        'status' => 'success',
                        'message' => 'Welcome!',

                        'studentID' => $studentID,
                        'customerName' => $studentName,
                        'type' => $userType

                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Invalid username or password.'
                    ];
                }
            } else {
                // User doesn't exist
                $response = [
                    'status' => 'error',
                    'message' => 'Invalid username or password.'
                ];
            }
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'All fields are mandatory'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>
