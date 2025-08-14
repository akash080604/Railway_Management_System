<!DOCTYPE html>
<html>
<head>
    <title>Train Booking System</title>
    <style>
        body {
            background-image: url(pnglogin.jpeg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], input[type="password"] {
            padding: 5px;
            width: 200px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        a {
            color: white;
            text-decoration: none;
        }
        .content-box {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php 
    session_start();
    require "db.php";

    $doj = $_POST["doj"];
    $_SESSION["doj"] = $doj;
    $sp = $_POST["sp"];
    $_SESSION["sp"] = $sp;
    $dp = $_POST["dp"];
    $_SESSION["dp"] = $dp;

    $query = mysqli_query($conn, "SELECT t.trainno, t.tname, c.sp, s1.departure_time, c.dp, s2.arrival_time, t.dd, c.class, c.fare, c.seatsleft FROM train as t, classseats as c, schedule as s1, schedule as s2 WHERE s1.trainno = t.trainno AND s2.trainno = t.trainno AND s1.sname = '".$sp."' AND s2.sname = '".$dp."' AND t.trainno = c.trainno AND c.sp = '".$sp."' AND c.dp = '".$dp."' AND c.doj = '".$doj."' ");

    echo "<table>";
    echo "<thead><tr><th>Train No</th><th>Train Name</th><th>Starting Point</th><th>Arrival Time</th><th>Destination Point</th><th>Departure Time</th><th>Day</th><th>Train Class</th><th>Fare</th><th>Seats Left</th></tr></thead>";
    
    while($row = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>".$row[0]."</td>";
        echo "<td>".$row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."</td>";
        echo "<td>".$row[5]."</td>";
        echo "<td>".$row[6]."</td>";
        echo "<td>".$row[7]."</td>";
        echo "<td>".$row[8]."</td>";
        echo "<td>".$row[9]."</td>";
        echo "</tr>";
    }
    echo "</table>";

    if(mysqli_num_rows($query) == 0) {
        echo "No such train <br>";
    }
?>
<div class="content-box">
    <p>If you wish to proceed with booking, fill in the following details:</p><br><br>
    <form action="resvn.php" method="post">
        Registered Mobile No: <input type="text" name="mno" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Enter Train No: <input type="text" name="tno" required><br><br>
        Enter Class: <input type="text" name="class" required><br><br>
        No. of Seats: <input type="text" name="nos" required><br><br>
        <input type="submit" value="Proceed with Booking"><br><br>
    </form>
</div>

<?php
    echo "<a href=\"http://localhost/railway/enquiry.php\">More Enquiry</a><br>";
    $conn->close(); 
?>

<br><a href="http://localhost/railway/index.htm">Go to Home Page!!!</a>
</body>
</html>
