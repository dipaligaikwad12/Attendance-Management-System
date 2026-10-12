<?php
error_reporting(0);
include '../Includes/dbconn.php';
include '../Includes/session.php';

if (isset($_POST['save'])){
  $className = $_POST['className'];
  $query=mysqli_query($conn,"INSERT INTO class(className) VALUES ('$className')");
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
  <link rel="stylesheet" href="./../css/login.css">
</head>

<body>
  <div>
    <?php include "./topbar.php"; ?>
    <div  class="attendanceView-container " >
      <?php include "./sidebar.php"; ?>
      <div>
        <div class="Dashboard-name">
          <h1>Create Class</h1>
        </div>
        <div class="viweAttendance-card">
          
          <button type="button" class="btn-view" onclick="openModel()" style="display:block;margin:auto">Create Class</button>
          <div class="overlay " id="overlay">
            <div class="card-body">
            <form method="post" action="">
            <img src="./../image/close.png" class="close-icon" onclick="closeModel()"><br>
              <label for="className" class="form-control-label">Class Name</label><br>
              <input type="text" name="className" class="form-control" required><br><br>
              <button type="submit" class="btn-view" name="save" >Save</button>
            </form>
            </div>
          </div>
        
        <div>
          <div>
            <h6 style=" padding:5px" class="side-text">All Classes</h6>
          </div>
          <div>
            <table class="table " id="studentTable">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Class Name</th>
                  
                </tr>
              </thead>
              <tbody >
              <?php
                      $query = "SELECT * FROM class";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
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