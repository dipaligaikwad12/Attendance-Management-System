<?php
include '../Includes/dbconn.php';
include '../Includes/session.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="./../image/logo.png">
    <title>AMS-Dashboard</title>
</head>

<body>
    <?php include "./topbar.php"; ?>
    <div class="dash-container">
        <div>
            <?php include "./sidebar.php"; ?>
        </div>
        <div class="full-page-container">

            <h1 class="Dashboard-name">Administrator Dashboard
            </h1>
            <div style="display: flex;">
                <div>
                    <div class="dashboard-card">
                        <div>
                            <i class="fas fa-users fa-2x text-info dash-icon" style="color: #ff80bf;"></i>
                        </div><br>
                        <div class="font " style="margin-left: 80px;">Students <?php
                                                                                $query1 = mysqli_query($conn, "SELECT * from student");
                                                                                $students = mysqli_num_rows($query1);
                                                                                echo $students;
                                                                                ?></div>
                    </div>
                    <div class="dashboard-card">
                        <div>
                            <i class="fas fa-chalkboard fa-2x text-primary dash-icon" style="color:#00cc00;"></i>
                        </div><br>
                        <div class="font" style="margin-left: 80px;">Classes <?php
                                                                                $query1 = mysqli_query($conn, "SELECT * from class");
                                                                                $class = mysqli_num_rows($query1);
                                                                                echo $class;
                                                                                ?></div>
                    </div>
                </div>
                <div>
                    <div class="dashboard-card">

                        <div>
                            <i class="fas fa-code-branch fa-2x text-success dash-icon" style="color:#ff944d"></i>
                        </div><br>
                        <div class="font" style="margin-left: 80px;">Teachers <?php
                                                                                $query1 = mysqli_query($conn, "SELECT * from tblclassteacher");
                                                                                $teacher = mysqli_num_rows($query1);
                                                                                echo $teacher;
                                                                                ?></div>
                    </div>
                    <div class="dashboard-card">
                        <div>
                            <i class="fas fa-calendar fa-2x text-warning dash-icon" style="color:#bf80ff"></i>
                        </div><br>
                        <div class="font" style="margin-left: 10px;">Total Student Attendance
                            <?
                            $query1 = mysqli_query($conn, "SELECT * from attendance6");
                            $totAttendance = mysqli_num_rows($query1);
                            echo $totAttendance;
                            ?></div>
                    </div>
                </div>
            </div>

</body>

</html>