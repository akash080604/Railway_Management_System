<!DOCTYPE html>
<html>
<head>
    <style>
        .content-box {
            width: 800px;
            margin: 0 auto; /* Center the content box horizontally */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        body {
            background-image: url(admin.jpg);
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>

<div class="content-box">
    <?php
    require "db.php";

    $query = "SELECT * FROM resv where status='BOOKED' ";
    $result = mysqli_query($conn, $query);

    echo "<table><thead><td>PNR</td><td>Id</td><td>Train_no</td><td>Date_Of_Journey</td><td>Fare</td><td>Train_Class</td><td>Seats</td><td>Status</td></thead>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr>";
    }

    echo "</table>";

    echo "<br> <a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";

    $conn->close();
    ?>
</div>

</body>
</html>
