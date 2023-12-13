<?php
include '../../connection.php';
session_start();

// Dropdowns province,town,barangay
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['provinceID'])) {
      $provinceID = $_GET['provinceID'];
      // Fetch town based on the selected province
      $sql = "SELECT * FROM town_table WHERE Province_ID = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $provinceID);
      $stmt->execute();
      $result = $stmt->get_result();
      $towns = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($towns);
  } elseif (isset($_GET['townID'])) {
      $townID = $_GET['townID'];
      // Fetch brgy based on the selected town
      $query = "SELECT * FROM barangay_table WHERE Town_ID = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("i", $townID);
      $stmt->execute();
      $result = $stmt->get_result();
      $brgy = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($brgy);
    }
}

 if ($_SERVER['REQUEST_METHOD'] === 'POST' &&isset($_POST['addAdmin']) ) {
     $firstName = $conn->real_escape_string($_POST["firstName"]);
     $middleName = $conn->real_escape_string($_POST["middleName"]);
     $lastName = $conn->real_escape_string($_POST["lastName"]);
     $extension = $conn->real_escape_string($_POST["extension"]);
     $bday = $conn->real_escape_string($_POST["bday"]);
     $formattedDate = date('Y-m-d', strtotime($bday));
     $age = $conn->real_escape_string($_POST["age"]);
     $gender = $conn->real_escape_string($_POST["gender"]);
     $civilStatus = $conn->real_escape_string($_POST["civilStatus"]);
     $street = $conn->real_escape_string($_POST["street"]);
     $address = $conn->real_escape_string($_POST["address"]);
     $province = $conn->real_escape_string($_POST["province"]);
     $town = $conn->real_escape_string($_POST["town"]);
     $barangay = $conn->real_escape_string($_POST["barangay"]);
     $zip = $conn->real_escape_string($_POST["zip"]);
     $username = $conn->real_escape_string($_POST["username"]);
     $password = $conn->real_escape_string($_POST["password"]);

     if(!empty($firstName) && !empty($middleName) && !empty($lastName) && !empty($extension) && !empty($bday) && !empty($age) && !empty($gender) && !empty($civilStatus) && !empty($street) && !empty($address) && !empty($province) && !empty($town) && !empty($barangay) && !empty($zip) && !empty($username) && !empty($password)){

        $sql = "INSERT INTO admin_table(AdminFirstname,AdminMiddlename,AdminLastname,AdminExtensionname,Admin_Birthdate,Admin_Age,Gender_ID,Civil_Status_ID,Street_Number,Address_Name,Province_ID,Town_ID,Barangay_ID,Zip_Code,Username,Password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssiiissiiiiss", $firstName,$middleName,$lastName,$extension,$formattedDate,$age,$gender,$civilStatus,$street,$address,$province,$town,$barangay,$zip,$username,$password);

       if ($stmt->execute()) {
            $_SESSION['message'] = 'success';
        }

        $stmt->close();
        $conn->close();

        header('Location: create.php');
        exit();
     }else{
      // Message if empty
    die("Error: " . $conn->error);
      header('Location: create.php');
      exit();
    }
}

// Fetch/Edit data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editAdminID'])) {
    $editAdminID = $_POST['editAdminID'];
    $stmt = $conn->prepare("SELECT * FROM admin_table WHERE Admin_ID = ?");
    $stmt->bind_param("i", $editAdminID);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateAdminID'])) {
    $updateAdminID = $conn->real_escape_string($_POST["updateAdminID"]);
   
    $firstName = $conn->real_escape_string($_POST["firstName"]);
    $middleName = $conn->real_escape_string($_POST["middleName"]);
    $lastName = $conn->real_escape_string($_POST["lastName"]);
    $extension = $conn->real_escape_string($_POST["extension"]);
    $bday = $conn->real_escape_string($_POST["bday"]);
    $formattedDate = date('Y-m-d', strtotime($bday));
    $age = $conn->real_escape_string($_POST["age"]);
    $gender = $conn->real_escape_string($_POST["gender"]);
    $civilStatus = $conn->real_escape_string($_POST["civilStatus"]);
    $street = $conn->real_escape_string($_POST["street"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $province = $conn->real_escape_string($_POST["province"]);
    $town = $conn->real_escape_string($_POST["town"]);
    $barangay = $conn->real_escape_string($_POST["barangay"]);
    $zip = $conn->real_escape_string($_POST["zip"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $stmt = $conn->prepare("UPDATE admin_table SET AdminFirstname=?,AdminMiddlename=?,AdminLastname=?,AdminExtensionname=?,Admin_Birthdate=?,Admin_Age=?,Gender_ID=?,Civil_Status_ID=?,Street_Number=?,Address_Name=?,Province_ID=?,Town_ID=?,Barangay_ID=?,Zip_Code=?,Username=?,Password=? WHERE Admin_ID=?");

    $stmt->bind_param("sssssiiissiiiissi", $firstName,$middleName,$lastName,$extension,$formattedDate,$age,$gender,$civilStatus,$street,$address,$province,$town,$barangay,$zip,$username,$password,$updateAdminID);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Record updated successfully.'));
    } else {
        // echo json_encode(array('success' => false,'message' => 'Failed to update record.'));
        die($conn->error);
    }

    $stmt->close();
    $conn->close();
}


//  Delete Student
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteAdminID'])) {
    $deleteAdminID = $_POST['deleteAdminID'];

    $stmt = $conn->prepare("DELETE FROM admin_table WHERE Admin_ID=?");
    $stmt->bind_param("i", $deleteAdminID);

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