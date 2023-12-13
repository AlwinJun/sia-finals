<?php
include 'connection.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
  $username = $conn->real_escape_string($_POST["username"]);
  $password = $conn->real_escape_string($_POST["password"]);
  $role = $conn->real_escape_string($_POST["role"]);


  if($role === 'Student'){   
    $sql= "SELECT  Student_Username,Student_Password,Student_ID FROM student_table WHERE Student_Username= ? AND Student_Password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if($result->num_rows === 1){
      $row =$result->fetch_assoc();
      
      $_SESSION['studentLogin'] = true;
       $_SESSION['studentID'] = $row['Student_ID'];


      // Redirect to the student dashboard and pass the student ID in the URL
      header("Location: student-dashboard/index.php");
      exit();

    }else {
      die("Invalid username or password") ;
    }
  }elseif($role === 'Parent'){
    $sql= "SELECT  Parent_Username,Parent_Password,Parent_ID FROM parent_table WHERE Parent_Username= ? AND Parent_Password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if($result->num_rows === 1){
      $row =$result->fetch_assoc();
      
      $_SESSION['parentLogin'] = true;
      $_SESSION['parentID'] = $row['Parent_ID'];

      // Redirect to the student dashboard and pass the student ID in the URL
      header("Location: parent-dashboard/index.php");
      exit();

    }else {
      die("Invalid username or password") ;
    }
  }elseif($role === 'Admin'){
    $sql= "SELECT  Username,Password,Admin_ID FROM admin_table WHERE Username= ? AND Password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if($result->num_rows === 1){
      $row =$result->fetch_assoc();
      
      $_SESSION['adminLogin'] = true;
     $_SESSION['adminID'] = $row['Admin_ID'];

      // Redirect to the student dashboard and pass the student ID in the URL
      header("Location: admin-dashboard/index.php?");
      exit();

    }else {
      die("Invalid username or password") ;
    }

  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Student Information System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="src/log.css">
</head>

<body style="background: #214a80;">
  <div class="login-dark" style="height: 695px;">
    <form method="POST">
      <h2 class="sr-only">Login</h2>
      <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
      <div class="form-group">
        <input class="form-control" type="text" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Password" required>
      </div>
      <div class="form-group">
        <select class="form-select" name="role" aria-label="Default select example">
          <option value="Student">Student</option>
          <option value="Parent">Parent</option>
          <option value="Admin">Admin</option>
        </select>
      </div>
      <div class="form-group">
        <button class="btn btn-primary btn-block" type="submit" name="login">Log In</button>
      </div>
      <p class="register">By login inyou agree to the terms and conditions</p>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>

</html>