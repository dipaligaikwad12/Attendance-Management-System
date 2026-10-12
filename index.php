<?php
include 'Includes/dbconn.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image" href="./image/logo.png">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>AMS-Dashboard</title>
</head>

<body>
  <img src="./image/home-img.jpg" class="home-image" alt="home-image" />
  <button type="button" class="login-btn" onclick="openModel()">Login</button>



  <div class="overlay" id="overlay">
    <div class="modal">
      <h5 class="macondo-regular heading align " style="color: #fff;">STUDENT ATTENDANCE SYSTEM</h5>
      <div class="login-container">
        <div class="text-center">
          <img src="image/logo.png" style="width:100px;height:100px" class="logo-img" alt="logo-image">
          <br><br>
          <h1 class="macondo-regular align">Login Panel</h1>
        </div>
        <form method="Post" action="">
          <div class="input-container">
            <div class="form-group">
              <select required name="userType" class=" macondo-regular input in-width">
                <option value="">--Select User Roles--</option>
                <option value="Administrator">Administrator</option>
                <option value="ClassTeacher">ClassTeacher</option>
              </select>
            </div>
            <div>
              <input type="text" required name="username" class=" macondo-regular input" id="exampleInputEmail"
                placeholder="Enter Email Address">
            </div>
            <div>
              <input type="password" name="password" required class=" macondo-regular input" 
                placeholder="Enter Password">
            </div>
            <div>
              <input type="submit" class=" input macondo-regular btn in-width " class="input" value="Login"
                name="login" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    function openModel(){
      const overlayElement = document.getElementById('overlay');
      overlayElement.style.display = 'flex';
    }
  </script>

<?php

if (isset($_POST['login'])) {

  $userType = $_POST['userType'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = md5($password);

  if ($userType == "Administrator") {

    $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();

    if ($num > 0) {

      $_SESSION['userId'] = $rows['Id'];
      $_SESSION['firstName'] = $rows['firstName'];
      $_SESSION['lastName'] = $rows['lastName'];
      $_SESSION['emailAddress'] = $rows['emailAddress'];

      echo "<script type = \"text/javascript\">
      window.location = (\"Admin/index.php\")
      </script>";
    } else {

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";
    }
  } else if ($userType == "ClassTeacher") {

    $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();

    if ($num > 0) {

      $_SESSION['userId'] = $rows['Id'];
      $_SESSION['firstName'] = $rows['firstName'];
      $_SESSION['lastName'] = $rows['lastName'];
      $_SESSION['emailAddress'] = $rows['emailAddress'];
      $_SESSION['classId'] = $rows['classId'];
      $_SESSION['classArmId'] = $rows['classArmId'];

      echo "<script type = \"text/javascript\">
      window.location = (\"ClassTeacher/index.php\")
      </script>";
    } else {

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";
    }
  } else {

    echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";
  }
}
?>
</body>

</html>