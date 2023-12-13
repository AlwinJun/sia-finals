<?php

include '../../connection.php';
session_start();

// Add Province
if(isset($_POST['addProvince']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $province = $conn->real_escape_string($_POST["province"]);

  if(!empty($province)){

    $sql = "INSERT INTO province_table(Province_name) VALUES(?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $province);

     if ($stmt->execute()) {
            $_SESSION['message'] = 'success';
        }

        $stmt->close();
        $conn->close();

        header('Location: province.php');
        exit();
  }else{
    // Message if empty
    header('Location: province.php');
    exit();
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editProvinceID'])) {
    $editProvinceID = $_POST['editProvinceID'];
    $stmt = $conn->prepare("SELECT * FROM province_table WHERE Province_ID = ?");
    $stmt->bind_param("i", $editProvinceID);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProvinceID'])) {
    $updateProvinceID = $conn->real_escape_string($_POST["updateProvinceID"]);
   
    $province = $conn->real_escape_string($_POST["province"]);

    $stmt = $conn->prepare("UPDATE province_table SET Province_Name=? WHERE Province_ID=?");

    $stmt->bind_param("si",$province,$updateProvinceID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        die($conn->error);
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProvinceID'])) {
    $deleteProvinceID = $_POST['deleteProvinceID'];

    $stmt = $conn->prepare("DELETE FROM province_table WHERE Province_ID=?");
    $stmt->bind_param("i", $deleteProvinceID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } else {
        // echo "Error: " . $conn->error;
        echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
    }

    $stmt->close();
    $conn->close();
}




// Add Town
if(isset($_POST['addTown']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $town = $conn->real_escape_string($_POST["town"]);
  $province = $conn->real_escape_string($_POST["province"]);

  if(!empty($town) && !empty($province)){

    
    $sql = "INSERT INTO town_table(Town_Name,Province_ID) VALUES(?,?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $town,$province);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'success';
        }

        $stmt->close();
        $conn->close();

        header('Location: town.php');
        exit();
  }else{
    // Message if empty
    header('Location: town.php');
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editTownID'])) {
    $editTownID = $_POST['editTownID'];
    $stmt = $conn->prepare("SELECT * FROM town_table WHERE Town_ID = ?");
    $stmt->bind_param("i", $editTownID);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateTownID'])) {
    $updateTownID = $conn->real_escape_string($_POST["updateTownID"]);
   
    $province = $conn->real_escape_string($_POST["province"]);
    $town = $conn->real_escape_string($_POST["town"]);

    $stmt = $conn->prepare("UPDATE town_table SET Town_Name=?,Province_ID=? WHERE Town_ID=?");

    $stmt->bind_param("sii",$town,$province,$updateTownID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        die($conn->error);
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTownID'])) {
    $deleteTownID = $_POST['deleteTownID'];

    $stmt = $conn->prepare("DELETE FROM town_table WHERE Town_ID=?");
    $stmt->bind_param("i", $deleteTownID);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record deleted successfully.']);
    } else {
        // echo "Error: " . $conn->error;
        echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
    }

    $stmt->close();
    $conn->close();
}



// Add Barangay
if(isset($_POST['addBarangay']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $town = $conn->real_escape_string($_POST["town"]);
  $barangay = $conn->real_escape_string($_POST["barangay"]);

  if(!empty($town) && !empty($barangay)){

    $sql = "INSERT INTO barangay_table(Barangay_Name,Town_ID) VALUES(?,?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $barangay,$town);

     if ($stmt->execute()) {
            $_SESSION['message'] = 'success';
      }

    $stmt->close();
    $conn->close();

    header('Location: barangay.php');
    exit();
  }else{
    // Message if empty
    header('Location: barangay.php');
    exit();
  }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editBarangayID'])) {
    $editBarangayID = $_POST['editBarangayID'];
    $stmt = $conn->prepare("SELECT * FROM barangay_table WHERE Barangay_ID = ?");
    $stmt->bind_param("i", $editBarangayID);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateBarangayID'])) {
    $updateBarangayID = $conn->real_escape_string($_POST["updateBarangayID"]);
    
    $barangay = $conn->real_escape_string($_POST["barangay"]);
    $town = $conn->real_escape_string($_POST["town"]);

    $stmt = $conn->prepare("UPDATE barangay_table SET Barangay_Name=?,Town_ID=? WHERE Barangay_ID=?");

    $stmt->bind_param("sii",$barangay,$town,$updateBarangayID);
    var_dump($_POST);

    if ($stmt->execute()) {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
         http_response_code(500);
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        // die($conn->error);;
    }

    $stmt->close();
    $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBarangayID'])) {
    $deleteBarangayID = $_POST['deleteBarangayID'];

    $stmt = $conn->prepare("DELETE FROM barangay_table WHERE Barangay_ID=?");
    $stmt->bind_param("i", $deleteBarangayID);
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