<?php
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected date
    $attendance_date = $_POST['attendance_date'];

    // Validate the date format (optional, depending on your requirements)
    if (DateTime::createFromFormat('Y-m-d', $attendance_date) !== false) {
        // Query to fetch attendance for the specific date
        $sql = "SELECT DISTINCT student_name, status FROM attendance6 WHERE attendance_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $attendance_date);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any records were found
        if ($result->num_rows > 0) {
            // Prepare CSV file
            $csv_file = "attendance_" . $attendance_date . ".csv";
            $file = fopen($csv_file, 'w');

            // Add headers to CSV
            fputcsv($file, [ 'Student Name', 'Attendance Status']);

            // Add attendance data to CSV
            while ($row = $result->fetch_assoc()) {
                fputcsv($file, [$row['student_name'], $row['status']]);
            }

            // Close the file
            fclose($file);

            // Set headers to force download of CSV
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $csv_file . '"');
            readfile($csv_file);

            // Delete the CSV file after download
            unlink($csv_file);
            exit;
        } else {
            $statusMsg = "<p class='statusMsgErr'>No attendance data found for the selected date.</p>";
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "Invalid date format.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="./../image/logo.png">
    
    <title>Download Attendance</title>
    <link rel="stylesheet" href="./../css/style.css">
</head>
<body>
<?php include "Includes/topbar.php"; ?>
<div id="content-wrapper" class="attendanceView-container">
      <?php include "Includes/sidebar.php"; ?>
      <div>
      <div>
      <h1 class="Dashboard-name">Download Attendance</h1>
      </div>
      <div class="viweAttendance-card">
      <div>
    <h6 style="color: blue; padding:5px" class="side-text">Download Attendance for a Specific Date</h6>
      </div>
    <form action="" method="post">
        <label for="attendance_date" class="form-control-label">Enter Attendance Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" class="form-control" required><br>
        <input type="submit" value="Download Attendance" class="btn-view" name="show_attendance">
        <?php echo "$statusMsg;" ?>
    </form>
    
      </div>
      </div>
</div>

</body>
</html>
