<!DOCTYPE html>
<html>
<head>
  <style>
    .content-box {
      width: 950px;
      margin: 0 auto; /* Center the content box horizontally */
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body style="background-image: url(userlogin.jpg);
    height: 100vh;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">

<div class="content-box">
  <?php
  session_start();
  require "db.php";

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $mobile = $_POST["mno"];
  $pwd = $_POST["password"];

  $query = mysqli_query($conn, "SELECT * FROM user WHERE user.mobileno=$mobile AND user.password='".$pwd."' ") or die(mysql_error());

  $temp1;
  $temp2;
  if ($row = mysqli_fetch_array($query)) {
    echo "Welcome ";
    $temp1 = $row['emailid'];
    $temp2 = $row['id'];
    echo "$temp1";
    echo "<br><br>";

    $query2 = mysqli_query($conn, "SELECT * FROM user,resv WHERE user.id=resv.id AND  user.mobileno=$mobile ") or die(mysql_error());

    echo "<table><thead><td>PNR</td><td>Train_no</td><td>Date_Of_Journey</td><td>Total_Fare</td><td>Train_Class</td><td>Seats_Reserved</td><td>Status</td><td>Generate Invoice</td></thead>";

    while ($row = mysqli_fetch_array($query2)) {
      echo "<tr><td>".$row["pnr"]."</td><td>".$row["trainno"]."</td><td>".$row["doj"]."</td><td>".$row["tfare"]."</td><td>".$row["class"]."</td><td>".$row["nos"]."</td><td>".$row["status"]."</td>";

      // Modify link to generate invoice
      echo '<td><a href="print.php?pnr='.$row["pnr"].'">Generate Invoice</a></td></tr>';
    }

    echo "</table>";

    if (mysqli_num_rows($query2) == 0) {
      echo "No Reservations Yet !!! <br><br> ";
    }
  }

  $_SESSION["id"] = $temp2;

  if (mysqli_num_rows($query) == 0) {
    echo "Wrong Combination!!! <br><br> ";
    echo " <a href=\"http://localhost/railway/index.htm\">Home Page</a><br>";
    die();
  }
  ?>

  <form action="cancel.php" method="post">
    Enter PNR for Cancellation: <input type="text" name="cancpnr" required><br><br>
    <input type="submit" value="Cancel"><br><br>
  </form>

  <?php
  echo " <a href=\"http://localhost/railway/index.htm\">Home Page</a><br>";

  $conn->close();
  ?>
</div>

</body>
</html>
