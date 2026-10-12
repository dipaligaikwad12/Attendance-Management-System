<?php 
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';

$query = "SELECT * FROM student";

    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rrw = $rs->fetch_assoc();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <div>
                    <h1 class="Dashboard-name">All Student in Class</h1>
                </div>
                <div class="viweAttendance-card">
                    <div>
                        <h6 style="color: blue; padding:5px" class="side-text">All Student In Class</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table" >
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Admission No</th>
                                    <th>Class</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                      $query = "SELECT * FROM student";
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
                                <td>".$rows['admissionNo']."</td>
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
    
</body>

</html>