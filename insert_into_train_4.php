<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('admin.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover; /* Ensure the background image covers the entire page */
            height: 100vh; /* Set body height to 100% of viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .content-box {
            width: 400px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="content-box">
        <?php
        session_start();

        require "db.php";

        $sql = "INSERT INTO train (tname,sp,st,dp,dt,dd,distance) VALUES ('".$_SESSION["tname"]."','".$_SESSION["sp"]."','".$_SESSION["st"]."','".$_SESSION["dp"]."','".$_SESSION["dt"]."','".$_SESSION["dd"]."','".$_SESSION["ds"]."')";

        if ($conn->query($sql) === TRUE) {
            echo "New Train record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $cdquery = "SELECT trainno FROM train where tname='".$_SESSION["tname"]."' AND sp='".$_SESSION["sp"]."' AND dp='".$_SESSION["dp"]."'";
        $cdresult = mysqli_query($conn, $cdquery);
        $cdrow = mysqli_fetch_array($cdresult);
        $trainno = $cdrow['trainno'];

        $sql = "INSERT INTO schedule (trainno,sname,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_SESSION["sp"]."','".$_SESSION["st"]."','".$_SESSION["st"]."','0')";
        $flag = ($conn->query($sql));
        $temp = 1;
        while ($temp <= $_SESSION["ns"]) {
            $sql = "INSERT INTO schedule (trainno,sname,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_POST["stn".$temp]."','".$_POST["st".$temp]."','".$_POST["dt".$temp]."','".$_POST["ds".$temp]."')";
            $flag = ($conn->query($sql));
            $temp += 1;
        }
        $sql = "INSERT INTO schedule (trainno,sname,arrival_time,departure_time,distance) VALUES ('".$trainno."','".$_SESSION["dp"]."','".$_SESSION["dt"]."','".$_SESSION["dt"]."','".$_SESSION["ds"]."')";
        $flag = ($conn->query($sql));

        if ($flag === TRUE) {
            echo "<br>New schedule added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        echo "<br> <a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";
        ?>
    </div>
</body>
</html>
