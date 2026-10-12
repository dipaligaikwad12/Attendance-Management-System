<?php
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image" href="./../image/logo.png">
  <title>AMS-Dashboard</title>
  <link rel="stylesheet" href="./../css/style.css">
  <link rel="stylesheet" href="./../css/teacher.css">



</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "Includes/topbar.php"; ?>
    <div id="content-wrapper" class="attendanceView-container">
      <?php include "Includes/sidebar.php"; ?>


      <div id="content">
        <div class="container-fluid" id="container-wrapper">
          <div>
            <h1 class="Dashboard-name">View Student Attendance</h1>
          </div>

          <div class="viweAttendance-card">
            <div>
              <h6 style="color: blue; padding:5px" class="side-text">View Student Attendance</h6>
              <?php echo $statusMsg; ?>
            </div>
            <form method="post" action="">
              
                <label class="form-control-label">Select Student:</label>
                <?php
                $qry = "SELECT * FROM attendance6  ORDER BY student_name ASC";
                $result = $conn->query($qry);
                $num = $result->num_rows;
                if ($num > 0) {
                  echo ' <select required name="admissionNo" class="form-control mb-3">';
                  echo '<option value="" id="student_name" name="student_name">--Select Student--</option>';
                  while ($rows = $result->fetch_assoc()) {
                    echo '<option value="' . $rows['admissionNo'] . '" >' . $rows['student_name'] . ' ' . $rows['lastName'] . '</option>';
                  }
                  echo '</select>';
                }
                ?><br>
                <button type="submit" name="view" class="btn-view">View Attendance</button>
              

            </form>
            <table class="table ">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Admission No</th>
                  <th>Class</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>

              <tbody>
                <?php
                // Check if the form was submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Get the student name from the form
                  $student_name = $_POST['student_name'];

                  // Sanitize input to prevent SQL injection
                  $student_name = $conn->real_escape_string($student_name);

                  // Query to fetch attendance details
                  $sql = "SELECT * FROM attendance6 WHERE student_name = '$student_name' ORDER BY attendance_date DESC";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    echo "<h3>Attendance Records for $student_name</h3>";
                    echo "<table border='1'>
              <tr>
                  <th>Date</th>
                  <th>Status</th>
              </tr>";

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                  <td>" . $row["attendance_date"] . "</td>
                  <td>" . $row["status"] . "</td>
              </tr>";
                    }
                    echo "</table>";
                  } else {
                    echo "No attendance records found for $student_name.";
                  }
                }
                ?>

          </div>
        </div>

      </div>
    </div>


  </div>
  <!---Container Fluid-->
  </div>

  </div>
  </div>





</body>

</html>