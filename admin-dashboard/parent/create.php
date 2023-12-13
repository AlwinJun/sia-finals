<?php 
include '../../connection.php';
session_start();
$genderResult = $conn->query("SELECT * FROM gender_table ORDER BY Gender_Name ASC");
$civilResult = $conn->query("SELECT * FROM civil_table ORDER BY Civil_Status_Name ASC");
$provinceResult = $conn->query("SELECT * FROM province_table ORDER BY Province_Name ASC");
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
  <link rel="stylesheet" href="../../src/style.css">
</head>

<body>

  <aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <i class="uil-bars close-aside d-md-none d-lg-none" data-close="show-side-navigation1"></i>
    <ul class="categories list-unstyled mt-4">
      <li class="">
        <i class="uil-folder"></i><a href="../index.php">Dashboard</a>
      </li>
      <li class="has-dropdown">
        <i class=""></i><a href="#">Student Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="../student/create.php">Create Student</a></li>
          <li><a href="../student/records.php">Student Records</a></li>
        </ul>
      </li>
      <li class=" has-dropdown">
        <i class="uil-calendar-alt"></i><a href="#"> Parent Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="create.php">Create Parent</a></li>
          <li><a href="records.php">Parent Records</a></li>
        </ul>
      </li>
      <li class="">
        <i class="uil-folder"></i><a href="../gender.php">Manage Gender</a>
      </li>
      <li class="">
        <i class="uil-folder"></i><a href="../civil-status.php">Manage Civil Status</a>
      </li>
      <li class="has-dropdown">
        <i class="uil-envelope-download fa-fw"></i><a href="#">Address Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="../address/province.php">Create Province</a></li>
          <li><a href="../address/town.php">Create Town</a></li>
          <li><a href="../address/barangay.php">Create Barangay</a></li>

        </ul>
      </li>
      <li class="has-dropdown">
        <i class="uil-calendar-alt"></i><a href="#">Admin Management</a>
        <ul class="sidebar-dropdown list-unstyled">
          <li><a href="../admin/create.php">Create Admin</a></li>
          <li><a href="../admin/records.php">Admin Records</a></li>
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
          <!-- <a class="navbar-brand" href="#">admin<span class="main-color">kit</span></a> -->
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
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                My account
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
                <li><a class="dropdown-item" href="../../logout.php">Log out</a></li>
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
            </li>
          </ul>
        </div>

      </div>
    </nav>

    <div class="p-4">
      <div class="welcome">
        <h1 class="fs-3">Add Parent</h1>
      </div>
    </div>

    <!-- Add Parent -->
    <div class="mx-4">
      <form action="process.php" method="POST" class="row g-3">
        <div class="col-md-3">
          <label for="firstName" class="form-label">First name</label>
          <input type="text" class="form-control" id="firstName" name="firstName">
        </div>
        <div class="col-md-3">
          <label for="middleName" class="form-label">Middle Name</label>
          <input type="text" class="form-control" id="middleName" name="middleName">
        </div>
        <div class="col-md-3">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName">
        </div>
        <div class="col-md-3">
          <label for="extension" class="form-label">Extension</label>
          <select class="form-select" aria-label="Default select example" id="extension" name="extension">
            <option value="N/A">N/A</option>
            <option value="Jr">Jr</option>
            <option value="Sr">Sr</option>
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="bday" class="form-label">Birthdate</label>
          <input type="date" class="form-control" id="bday" name="bday">
        </div>
        <div class="col-md-3">
          <label for="age" class="form-label">Age</label>
          <input type="text" class="form-control" id="age" name="age">
        </div>
        <div class="col-md-3">
          <label for="gender" class="form-label">Gender</label>
          <select class="form-select" aria-label="Default select example" id="gender" name="gender">
            <option value="">Select Gender</option>
            <?php foreach($genderResult as $row): ?>
            <option value="<?= $row['Gender_ID'] ?>"><?= $row['Gender_Name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-3">
          <label for="civilStatus" class="form-label">Civil Status</label>
          <select class="form-select" aria-label="Default select example" id="civilStatus" name="civilStatus">
            <option value="">Select Civil Status</option>
            <?php foreach($civilResult as $row): ?>
            <option value="<?= $row['Civil_Status_ID'] ?>"><?= $row['Civil_Status_Name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-3">
          <label for="street" class="form-label">Street Number</label>
          <input type="text" class="form-control" id="street" name="street">
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label">Address Name</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Ex. Puron/Street/Zone">
        </div>
        <div class="col-md-3">
          <label for="province" class="form-label">Province</label>
          <select class="form-select" aria-label="Default select example" id="province" name="province">
            <option value="">Select Province</option>
            <?php foreach($provinceResult as $row): ?>
            <option value="<?= $row['Province_ID'] ?>"><?= $row['Province_Name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-md-3">
          <label for="town" class="form-label">Town</label>
          <select class="form-select" aria-label="Default select example" id="town" name="town">
            <option value="">Select a province first</option>
            <!-- Fetch with ajax -->
          </select>
        </div>
        <div class="col-md-3">
          <label for="barangay" class="form-label">Barangay</label>
          <select class="form-select" aria-label="Default select example" id="barangay" name="barangay">
            <option value="">Choose a town first</option>
            <!-- Fetch with ajax -->
          </select>
        </div>
        <div class="col-md-3">
          <label for="zip" class="form-label">Zip Code</label>
          <input type="text" class="form-control" id="zip" name="zip">
        </div>
        <div class="col-md-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="col-md-3">
          <label for="password" class="form-label">Password</label>
          <input type="text" class="form-control" id="password" name="password">
        </div>
        <div class="col-md-9 d-flex align-items-center mt-5">
          <button type="submit" class="btn btn-success ms-auto me-2 px-4" name="addParent">Add Parent</button>
        </div>
      </form>

      <?php if(isset($_SESSION['message'])): ?>
      <!-- Success Modal -->
      <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="successModalLabel">Success</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Addedd Succesfully
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
      <!-- Error Modal -->
      <div class="modal fade messageModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
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
              Failed to add
            </div>
          </div>
        </div>
      </div>
      <?php endif; unset($_SESSION['message'])?>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

  <script src="../../src/index.js"></script>
  <script src="ajax.js"></script>
  <script src="../update-password.js"></script>
</body>

</html>