<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePasswordID'])) {
    $updatePasswordID = $conn->real_escape_string($_POST["updatePasswordID"]);
   
    $password = $conn->real_escape_string($_POST["password"]);
    $confirmPassword = $conn->real_escape_string($_POST["confirmPassword"]);

    if($password === $confirmPassword){

        $stmt = $conn->prepare("UPDATE student_table SET Student_Password=? WHERE Student_ID=?");

        $stmt->bind_param("si",$password,$updatePasswordID);

        if ($stmt->execute()) {
            echo json_encode(array('success' => true, 'message' => 'Password updated successfully.'));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Incorrect Password.'));
            die($conn->error);
        }

        $stmt->close();
        $conn->close();
    }else{
        echo json_encode(array('success' => false, 'message' => 'Incorrect Password.'));
    }
}

?>