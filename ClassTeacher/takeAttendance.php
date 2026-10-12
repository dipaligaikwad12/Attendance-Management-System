<?php
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';
// Get the list of students from the database (assuming you have a 'students' table)
$sql_students = "SELECT * FROM student";
$rs = $conn->query($sql_students);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance_date = date("Y-m-d"); // Current date
    $attendance_time = date("H:i:s"); // Current time

    if (isset($_POST['student_attendance'])) {
        foreach ($_POST['student_attendance'] as $student_name => $attendance_status) {
            $student_name = $conn->real_escape_string($student_name); // Sanitize input

            // Get student ID by name
            $sql_student_id = "SELECT * FROM student WHERE firstName = '$student_name'";
            $result_student_id = $conn->query($sql_student_id);

            if ($result_student_id->num_rows > 0) {
                $row_student_id = $result_student_id->fetch_assoc();


                $sql_insert_attendance = "INSERT INTO attendance6 (student_name, attendance_date, attendance_time, status) VALUES ('$student_name', '$attendance_date', '$attendance_time', '$attendance_status')";

                if ($conn->query($sql_insert_attendance) !== TRUE) {
                    echo "Error: " . $sql_insert_attendance . "<br>" . $conn->error;
                }
            } else {
                echo "Error: Student '$student_name' not found.<br>";
            }
        }
        $statusMsg = "<p class='statusMsg'>Attendance recorded successfully!</p>";
    }
}





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

<body>
    <div id="wrapper">
        <?php include "Includes/topbar.php"; ?>
        <div id="content-wrapper" class="attendanceView-container">
            <?php include "Includes/sidebar.php"; ?>

            <div>
                <div>
                    <h1 class="Dashboard-name">Take Attendance (Today's Date : <?php echo $dateTaken = date("d-m-Y"); ?>)</h1>
                </div>
                <div class="viweAttendance-card">
                    <form method="post" action="#">
                        <div>
                            <h6 style="color: blue; padding:5px" class="side-text">All Student in Class</h6>
                        </div>
                        <?php echo $statusMsg; ?>
                        <button type="submit" name="save" class="btn-view">Take Attendance</button>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Admission No</th>
                                    <th>Class</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $query = "SELECT * FROM student";
                                $rs = $conn->query($query);
                                $num = $rs->num_rows;
                                $sn = 0;
                                $status = "";
                                if ($num > 0) {
                                    while ($rows = $rs->fetch_assoc()) {
                                        $sn = $sn + 1;
                                        echo "
                              <tr>
                                <td>" . $sn . "</td>
                                <td>" . $rows['firstName'] . "</td>
                                <td>" . $rows['lastName'] . "</td>
                                
                                <td>" . $rows['admissionNo'] . "</td>
                                <td>" . $rows['className'] . "</td>
                                
                                <td><input type='radio' name='student_attendance[" . $rows["firstName"] . "]' value='present' required></td>;
                                <td><input type='radio' name='student_attendance[" . $rows["firstName"] . "]' value='absent' required></td>;
                              </tr>";
                                    }
                                } else {
                                    echo
                                    "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                                }

                                ?>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

</html>