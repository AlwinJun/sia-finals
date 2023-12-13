<?php
session_start();

  if(!isset($_SESSION['parentLogin'])){
    header('Location: ../index.php');
    exit();
  }

include '../connection.php';


$parentStmt = $conn->prepare("SELECT ParentFirstname, ParentMiddlename,  ParentLastname,ParentExtensionname,
                                Parent_Birthdate,
                                Gender_Name,
                                Parent_Age,
                                Civil_Status_Name,
                                Street_Number,  Barangay_Name, Town_Name,  Province_Name, Zipcode,
                                Parent_Username,
                                Parent_Password
                              FROM parent_table
                              INNER JOIN gender_table ON parent_table.Gender_ID = gender_table.Gender_ID
                              INNER JOIN civil_table ON parent_table.Civil_Status_ID = civil_table.Civil_Status_ID
                              INNER JOIN barangay_table ON parent_table.Barangay_ID = barangay_table.Barangay_ID
                              INNER JOIN town_table ON parent_table.Town_ID = town_table.Town_ID
                              INNER JOIN province_table ON parent_table.Province_ID = province_table.Province_ID WHERE Parent_ID=?");
$parentStmt->bind_param('i', $_SESSION['parentID']);
$parentStmt->execute();
$parentRow = $parentStmt->get_result()->fetch_assoc();

$studentStmt= $conn->prepare("SELECT Firstname,Middlename,Lastname,Extensionname,
                                Birthdate,
                                Gender_Name,
                                Age,
                                Civil_Status_Name,
                                student_table.Street_Number, 
                                Barangay_Name, 
                                Town_Name, 
                                Province_Name,
                                student_table.Zipcode,
                                student_table.Parent_ID,
                                CONCAT(ParentFirstname, ' ', ParentMiddlename, ' ', ParentLastname) AS ParentName
                          FROM student_table
                          INNER JOIN gender_table ON student_table.Gender_ID = gender_table.Gender_ID
                          INNER JOIN civil_table ON student_table.Civil_Status_ID = civil_table.Civil_Status_ID
                          INNER JOIN barangay_table ON student_table.Barangay_ID = barangay_table.Barangay_ID
                          INNER JOIN town_table ON student_table.Town_ID = town_table.Town_ID
                          INNER JOIN province_table ON student_table.Province_ID = province_table.Province_ID
                          INNER JOIN parent_table ON student_table.Parent_ID = parent_table.Parent_ID WHERE student_table.Parent_ID = ?");
$studentStmt->bind_param('i', $_SESSION['parentID']);
$studentStmt->execute();
$studentRows = $studentStmt->get_result()->fetch_all(MYSQLI_ASSOC);


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
      <li class="mt-5">
        <i class="uil-folder"></i><a href="index.php">Dashboard</a>
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
                          value="<?= $_SESSION['parentID'] ?>" name="updatePasswordID">
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

    <div id="carouselExampleInterval" class="carousel slide mt-4" data-bs-ride="carousel">
      <div class=" carousel-inner rounded-4">
        <div class="carousel-item active" data-bs-interval="1000">
          <img src="../assets/image1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img2jpg.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img3.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img5.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img3.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="1000">
          <img src="../assets/img2jpg.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Dashboard Cards -->
    <div class="mt-5 mx-4">
      <div class="row">

        <div class="col-2 p-3 bg-info rounded me-3">
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#parentModal" data-edit-id=>
            <div class="text-white p-1 d-flex flex-row align-items-center justify-content-between">
              <p><i class="fa-solid fa-person-breastfeeding" style="font-size: 3.5rem;"></i></p>
              <div class="text-center">
                <span>My Info</span>
              </div>
            </div>
          </button>

          <!-- Modal for viewing Parent-->
          <div class="modal fade" id="parentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="width: 750px; background-color: #eee;">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">My Info</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="viewForm" class="row g-3">
                    <div class="col-md-3">
                      <label for="firstName" class="form-label">First name</label>
                      <input type="text" class="form-control" id="firstName" name="firstName"
                        value="<?= $parentRow['ParentFirstname'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="middleName" class="form-label">Middle name</label>
                      <input type="text" class="form-control" id="middleName" name="middleName"
                        value="<?= $parentRow['ParentMiddlename'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="lastName" class="form-label">Last name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName"
                        value="<?= $parentRow['ParentLastname'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="lastName" class="form-label">Extension name</label>
                      <input type="text" class="form-control" id="lastName" name="lastName"
                        value="<?= $parentRow['ParentExtensionname'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="bday" class="form-label">Birthdate</label>
                      <input type="text" class="form-control" id="bday" name="bday"
                        value="<?= $parentRow['Parent_Birthdate'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="gender" class="form-label">Gender</label>
                      <input type="text" class="form-control" id="gender" name="gender"
                        value="<?= $parentRow['Gender_Name'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="age" class="form-label">Age</label>
                      <input type="text" class="form-control" id="age" name="age"
                        value="<?= $parentRow['Parent_Age'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="civilStatus" class="form-label">Civil Status</label>
                      <input type="text" class="form-control" id="civilStatus" name="civilStatus"
                        value="<?= $parentRow['Civil_Status_Name'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="street" class="form-label">Street No.</label>
                      <input type="text" class="form-control" id="street" name="street"
                        value="<?= $parentRow['Street_Number'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="barangay" class="form-label">Barangay</label>
                      <input type="text" class="form-control" id="barangay" name="barangay"
                        value="<?= $parentRow['Barangay_Name'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="town" class="form-label">Town</label>
                      <input type="text" class="form-control" id="town" name="town"
                        value="<?= $parentRow['Town_Name'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="province" class="form-label">Province</label>
                      <input type="text" class="form-control" id="province" name="province"
                        value="<?= $parentRow['Province_Name'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="zip" class="form-label">Zip Code</label>
                      <input type="text" class="form-control" id="zip" name="zip" value="<?= $parentRow['Zipcode'] ?>"
                        disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="username" class="form-label">Usernmae</label>
                      <input type="text" class="form-control" id="username" name="username"
                        value="<?= $parentRow['Parent_Username'] ?>" disabled readonly>
                    </div>
                    <div class="col-md-3">
                      <label for="username" class="form-label">Password</label>
                      <input type="text" class="form-control" id="username" name="username"
                        value="<?= $parentRow['Parent_Password'] ?>" disabled readonly>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-3 p-3 bg-success rounded me-3">
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#studentModal">
            <div class="text-white p-1 d-flex flex-row align-items-center justify-content-between">
              <p><i class="fa-solid fa-user" style="font-size: 3.5rem;"></i></p>
              <div class="text-center">
                <span class="text-center">Show Child Info</span>
              </div>
            </div>
          </button>
        </div>

        <!-- Modal for viewing Student-->
        <div class="modal fade" id="studentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <?php foreach($studentRows as $studentRow): ?>
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 750px; background-color: #eee;">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Child Info</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="viewForm" class="row g-3">
                  <div class="col-md-3">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName"
                      value="<?= $studentRow['Firstname'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="middleName" class="form-label">Middle name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName"
                      value="<?= $studentRow['Middlename'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName"
                      value="<?= $studentRow['Lastname'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="lastName" class="form-label">Extension name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName"
                      value="<?= $studentRow['Extensionname'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="bday" class="form-label">Birthdate</label>
                    <input type="text" class="form-control" id="bday" name="bday"
                      value="<?= $studentRow['Birthdate'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="gender" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender"
                      value="<?= $studentRow['Gender_Name'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?= $studentRow['Age'] ?>"
                      disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="civilStatus" class="form-label">Civil Status</label>
                    <input type="text" class="form-control" id="civilStatus" name="civilStatus"
                      value="<?= $studentRow['Civil_Status_Name'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="street" class="form-label">Street No.</label>
                    <input type="text" class="form-control" id="street" name="street"
                      value="<?= $studentRow['Street_Number'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="barangay" class="form-label">Barangay</label>
                    <input type="text" class="form-control" id="barangay" name="barangay"
                      value="<?= $studentRow['Barangay_Name'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="town" class="form-label">Town</label>
                    <input type="text" class="form-control" id="town" name="town"
                      value="<?= $studentRow['Town_Name'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="province" class="form-label">Province</label>
                    <input type="text" class="form-control" id="province" name="province"
                      value="<?= $studentRow['Province_Name'] ?>" disabled readonly>
                  </div>
                  <div class="col-md-3">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?= $studentRow['Zipcode'] ?>"
                      disabled readonly>
                  </div>
                  <div class="col-md-6">
                    <label for="parent" class="form-label">Parent</label>
                    <input type="text" class="form-control" id="parent" name="parent"
                      value="<?= $studentRow['ParentName'] ?>" disabled readonly>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>

  <script src=" https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>

  <script src="../src/index.js"></script>
  <script src="ajax.js"></script>
</body>

</html>