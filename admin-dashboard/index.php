<?php
    session_start();
    
  if(!isset($_SESSION['adminLogin'])){
    header('Location: ../index.php');
    exit();
  }
  include '../connection.php';

  $student_result = $conn->query("SELECT COUNT(*) as all_studetns FROM student_table");
  $student_row = $student_result->fetch_assoc(); 
  $all_student = $student_row["all_studetns"];

  $parent_result = $conn->query("SELECT COUNT(*) as all_parent FROM parent_table");
  $parent_row = $parent_result->fetch_assoc(); 
  $all_parent = $parent_row["all_parent"];

  $admin_result = $conn->query("SELECT COUNT(*) as all_admin FROM admin_table");
  $admin_row = $admin_result->fetch_assoc(); 
  $all_admin = $admin_row["all_admin"];
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
  <script src="https://kit.fontawesome.com/25c871887e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../src/style.css">
</head>

<body>

  <aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <ul class="categories list-unstyled mt-4">
      <li class="">
        <i class="uil-folder"></i><a href="index.php">Dashboard</a>
      </li>
      <li class="has-dropdown">
        <i class=""></i><a href="#">Student Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="student/create.php">Create Student</a></li>
          <li><a href="student/records.php">Student Records</a></li>
        </ul>
      </li>
      <li class=" has-dropdown">
        <i class="uil-calendar-alt"></i><a href="#"> Parent Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="parent/create.php">Create Parent</a></li>
          <li><a href="parent/records.php">Parent Records</a></li>
        </ul>
      </li>
      <li class="">
        <i class="uil-folder"></i><a href="gender.php">Manage Gender</a>
      </li>
      <li class="">
        <i class="uil-folder"></i><a href="civil-status.php">Manage Civil Status</a>
      </li>
      <li class="has-dropdown">
        <i class="uil-envelope-download fa-fw"></i><a href="#">Address Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="address/province.php">Create Province</a></li>
          <li><a href="address/town.php">Create Town</a></li>
          <li><a href="address/barangay.php">Create Barangay</a></li>

        </ul>
      </li>
      <li class="has-dropdown">
        <i class="uil-calendar-alt"></i><a href="#">Admin Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="admin/create.php">Create Admin</a></li>
          <li><a href="admin/records.php">Admin Records</a></li>
        </ul>
      </li>
    </ul>
  </aside>
  <section id="wrapper">
    <nav class="navbar navbar-expand-md">
      <div class="container-fluid mx-2">
        <div class="navbar-header">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggle-navbar"
            aria-controls="toggle-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="uil-bars text-white"></i>
          </button>
          <li class="nav-item nav-burger">
            <a class="nav-link" href="#">
              <span data-show="show-side-navigation1" class="show-side-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
              </span>
            </a>
          </li>
        </div>
        <div class="collapse navbar-collapse" id="toggle-navbar">
          <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Account
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <button type="button dropdown-item" class="btn" data-bs-toggle="modal"
                    data-bs-target="#editPassowrdModal">
                    Update Password
                  </button>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../logout.php">Log out</a></li>
              </ul>


              <div class="modal fade" id="editPassowrdModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content" style="width: 400px; background-color: #eee;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel">Update Password</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="editPasswordForm">
                        <div class="col-md-12 mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="updatePassword" name="updatePassword">
                        </div>
                        <div class="col-md-12 mb-3">
                          <label for="confirmPassword" class="form-label">Confirm Password</label>
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        </div>
                        <input type="hidden" class="form-control" id="updatePasswordID"
                          value="<?= $_SESSION['adminID'] ?>" name="updatePasswordID">
                        <div class="mt-2 col-12 d-flex flex-row-reverse pe-0">
                          <button type="submit" name="updatePasswordBtn" id="updatePasswordBtn"
                            class="btn btn-success ms-auto p-1">
                            <small>Update Password</small>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Success Modal -->
              <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="successModalLabel">Success</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Success message will appear here -->
                    </div>
                  </div>
                </div>
              </div>

              <!-- Error Modal -->
              <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="errorModalLabel">Error</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- Error message will appear here -->
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="p-4">
      <div class="welcome">
        <div class="content rounded-3 p-3">
          <h1 class="fs-3">Welcome to Admin dashboard</h1>
          <p class="mb-0">Good luck for todays work!</p>
        </div>
      </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="mt-5 mx-4">
      <div class="row">
        <div class="col-2 p-3 bg-primary rounded me-3">
          <div class="text-white px-1 pt-1 d-flex flex-row align-items-center justify-content-between">
            <p><i class="fa-solid fa-user-tie" style="font-size: 3.5rem;"></i></p>
            <div class="text-end">
              <p class=" m-0 fs-2 fw-bold"><?= $all_admin ?></p>
              <span>All Admins</span>
            </div>
          </div>
        </div>

        <div class="col-2 p-3 bg-success rounded me-3">
          <div class="text-white p-1 d-flex flex-row align-items-center justify-content-between">
            <p><i class="fa-solid fa-users" style="font-size: 3.5rem;"></i></p>
            <div class="text-end">
              <i class="fa-regular fa-users-medical"></i>
              <p class=" m-0 fs-2 fw-bold"><?= $all_student ?></p>
              <span>All Students</span>
            </div>
          </div>
        </div>

        <div class="col-2 p-3 bg-info rounded me-3">
          <div class="text-white p-1 d-flex flex-row align-items-center justify-content-between">
            <p><i class="fa-solid fa-hands-holding-child" style="font-size: 3.5rem;"></i></p>
            <div class="text-end">
              <p class=" m-0 fs-2 fw-bold"><?= $all_parent ?></p>
              <span>All Parents</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

  <script src="../src/index.js"></script>
  <script src="update-password.js"></script>
</body>

</html>