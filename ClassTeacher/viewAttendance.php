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
    <?php include "Includes/topbar.php"; ?>
    <!-- Sidebar -->

    <!-- Sidebar -->
    <div id="content-wrapper" class="attendanceView-container">
      <?php include "Includes/sidebar.php"; ?>
      <div id="content">
        <div class="">
          <h1 class="Dashboard-name">View Class Attendance</h1>
        </div>
        <!-- Form Basic -->
        <div class="viweAttendance-card">
          <div>
            <h6 style="color: blue; padding:5px" class="side-text">View Class Attendance</h6>
           
          </div>
          <form method="post" action="">
            <div>
              <label class="form-control-label">Select Date:</label>
              <input type="date" id="attendance_date" name="attendance_date" class="form-control" required>
            </div>
            <button type="submit" name="view" class="btn-view">View Attendance</button>
            
          </form>

          
              <?php
              // Check if the form was submitted
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the attendance date from the form
                $attendance_date = $_POST['attendance_date'];

                // Sanitize the input to prevent SQL injection
                $attendance_date = $conn->real_escape_string($attendance_date);

                // Query to fetch attendance details for the specific date
                $sql = "SELECT DISTINCT student_name,attendance_date,status FROM attendance6 WHERE attendance_date = '$attendance_date' ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  
                  echo "<h3>Attendance Records for $attendance_date</h3>";
                  echo "<table class='table'>
              <tr>
              <thead class='thead-light'>
              <th>Date</th>
                  <th>Student Name</th>
                  <th>Status</th>
                  </thead>
              </tr>";
              

                  // Output data of each row
                  while ($row = $result->fetch_assoc()) {
                    if($row['status'] == 'present'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                    echo "<tr>
          <td>" . $row["attendance_date"] . "</td>
                  <td>" . $row["student_name"] . "</td>
                  <td>" . $row["status"] . "</td>
              </tr>";
                  }
                  echo "</table>";
                } else {
                  echo "No attendance records found for $attendance_date.";
                }
              }


              ?>
            
        </div>
      </div>



    </div>
  </div>
  </div>
  </div>


  </div>
  <!---Container Fluid-->
  </div>

  </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script>

  </script>
</body>

</html>