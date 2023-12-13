<?php
include '../connection.php';
session_start();

// Add Gender
if(isset($_POST['addGender']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $gender = $conn->real_escape_string($_POST["gender"]);

  if(!empty($gender)){ 
    $sql = "INSERT INTO gender_table(Gender_Name) VALUES(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gender);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'success';
        }

        $stmt->close();
        $conn->close();

        header('Location: gender.php');
        exit();
  }else{
    // Message if empty
    header('Location: gender.php');
    exit();
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editGenderID'])) {
    $editGenderID = $_POST['editGenderID'];
    $stmt = $conn->prepare("SELECT * FROM gender_table WHERE Gender_ID = ?");
    $stmt->bind_param("i", $editGenderID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row); // Send the fetched row as JSON response
        } else {
            echo json_encode(array('error' => 'No records found'));
        }
    } else {
        echo json_encode(array('error' => 'Error executing query'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateGenderID'])) {
    $updateGenderID = $conn->real_escape_string($_POST["updateGenderID"]);
   
    $gender = $conn->real_escape_string($_POST["gender"]);

    $stmt = $conn->prepare("UPDATE gender_table SET Gender_Name=? WHERE Gender_ID=?");

    $stmt->bind_param("si",$gender,$updateGenderID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        die($conn->error);
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteGenderID'])) {
    $deleteGenderID = $_POST['deleteGenderID'];

    $stmt = $conn->prepare("DELETE FROM gender_table WHERE Gender_ID=?");
    $stmt->bind_param("i", $deleteGenderID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } else {
        // echo "Error: " . $conn->error;
        echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
    }

    $stmt->close();
    $conn->close();
}


// Add Civil Status
if(isset($_POST['addCivil']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $civil = $conn->real_escape_string($_POST["civilStatus"]);

  if(!empty($civil)){

    
    $sql = "INSERT INTO civil_table(Civil_Status_Name) VALUES(?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $civil);

     if ($stmt->execute()) {
        $_SESSION['message'] = 'success';
    }

    $stmt->close();
    $conn->close();

    header('Location: civil-status.php');
    exit();
  }else{
    // Message if empty
    header('Location: civil-status.php');
    exit();
  }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editCivilID'])) {
    $editCivilID = $_POST['editCivilID'];
    $stmt = $conn->prepare("SELECT * FROM civil_table WHERE Civil_Status_ID = ?");
    $stmt->bind_param("i", $editCivilID);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row); // Send the fetched row as JSON response
        } else {
            echo json_encode(array('error' => 'No records found'));
        }
    } else {
        echo json_encode(array('error' => 'Error executing query'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCivilID'])) {
    $updateCivilID = $conn->real_escape_string($_POST["updateCivilID"]);
   
    $civil = $conn->real_escape_string($_POST["civilStatus"]);

    $stmt = $conn->prepare("UPDATE civil_table SET Civil_Status_Name=? WHERE Civil_Status_ID=?");

    $stmt->bind_param("si",$civil,$updateCivilID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        die($conn->error);
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteCivilID'])) {
    $deleteCivilID = $_POST['deleteCivilID'];

    $stmt = $conn->prepare("DELETE FROM civil_table WHERE Civil_Status_ID=?");
    $stmt->bind_param("i", $deleteCivilID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } else {
        // echo "Error: " . $conn->error;
        echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePasswordID'])) {
    $updatePasswordID = $conn->real_escape_string($_POST["updatePasswordID"]);
   
    $password = $conn->real_escape_string($_POST["password"]);
    $confirmPassword = $conn->real_escape_string($_POST["confirmPassword"]);

    if($password === $confirmPassword){

        $stmt = $conn->prepare("UPDATE admin_table SET Password=? WHERE Admin_ID=?");

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