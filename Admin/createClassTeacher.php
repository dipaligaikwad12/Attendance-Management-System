<?php
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $emailAddress = $_POST['email'];
  $phoneNo = $_POST['phoneNo'];
  $className = $_POST['className'];

  $sampPass = "pass123";
  $sampPass_2 = md5($sampPass);

  $query = mysqli_query($conn, "INSERT INTO tblclassteacher (firstName,lastName,emailAddress,phoneNo,password,className) VALUES ('$firstName','$lastName','$emailAddress','$phoneNo','$sampPass_2','$className')");
  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image" href="./../image/logo.png">
  <title>AMS-Dashboard</title>
  <link rel="stylesheet" href="./../css/login.css">
  <link rel="stylesheet" href="./../css/style.css">
  <link rel="stylesheet" href="./../css/teacher.css">
  <link rel="stylesheet" href="./../css/admin.css">
</head>

<body>
  <div>
    <?php include "./topbar.php"; ?>

    <div class="attendanceView-container">
      <?php include "./sidebar.php"; ?>

      <div>

        <div class="Dashboard-name">
          <h1>Create Class Teachers</h1>

        </div>


        <div class="viweAttendance-card">
        <button type="button" class="btn-view" onclick="openModel()" style="display:block;margin:auto ;width:300px">Create Class Teacher</button>
        <div class="overlay " id="overlay">
          <div class="card-body">
            <form  method="post" action="#">
            <img src="./../image/close.png" class="close-icon" onclick="closeModel()"><br>
              <label class="form-control-label">First Name </label>
              <input type="text" class="form-control" name="firstName"><br><br>
              <label class="form-control-label">Last Name</label>
              <input type="text" class="form-control" name="lastName"><br><br>
              <label class="form-control-label">Email</label><br>
              <input type="email" class="form-control" name="email"><br><br>
              
              <label class="form-control-label">Phone No</label>
              <input type="text" class="form-control" name="phoneNo"><br><br>
              <label class="form-control-label">Class Name</label>
              <input type="text" class="form-control" name="className"><br><br>
              
              <button type="submit" class="btn-view" name="save">Save</button>
            </form>
          </div>
        </div>

          <div>
            <div>
              <h6 style="color: blue; padding:5px" class="side-text">All Class Teachers</h6>
            </div>
            <div>
              <table id="teacherTable" class="table">
                <thead class="thead-light">
                  <tr>
                    <th>Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Class Name</th>
                  
                  </tr>
                </thead>
                <tbody>
                <?php
                      $query = "SELECT * FROM tblclassteacher";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['emailAddress']."</td>
                                <td>".$rows['phoneNo']."</td>
                                <td>".$rows['className']."</td>
                                
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
    <script>
    function openModel(){
      const overlayElement = document.getElementById('overlay');
      overlayElement.style.display = 'flex';
    }
    function closeModel(){
    const overlayElement = document.getElementById('overlay');
    overlayElement.style.display= 'none';
}
  </script>
   

</body>

</html>