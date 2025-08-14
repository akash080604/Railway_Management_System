<!DOCTYPE html>
<html>
<head>
    <style>
        .content-box {
            width: 400px;
            margin: 0 auto; /* Center the content box horizontally */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        body {
            background-image: url(admin.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="content-box">
        <?php
        session_start();
        require "db.php";
        if(isset($_POST["ns"])) {
            $ns = $_POST["ns"];
            $tname = $_POST["tname"];
            $_SESSION["tname"] = $tname;
            $sp = $_POST["sp"];
            $_SESSION["sp"] = $sp;
            $st = $_POST["st"];
            $_SESSION["st"] = $st;
            $dp = $_POST["dp"];
            $_SESSION["dp"] = $dp;
            $dt = $_POST["dt"];
            $_SESSION["dt"] = $dt;
            $dd = $_POST["dd"];
            $_SESSION["dd"] = $dd;
            $ns = $_POST["ns"];
            $_SESSION["ns"] = $ns;
            $ds = $_POST["ds"];
            $_SESSION["ds"] = $ds;
    
            echo "<table><thead><td>Train_name</td><td>Starting_point</td><td>Starting_time</td><td>Destination_point</td><td>Destination_time</td><td>Day_of_arrival</td><td>No_of_stations</td><td>Distance</td></thead>";
            echo "<tr><td>".$tname."</td><td>".$sp."</td><td>".$st."</td><td>".$dp."</td><td>".$dt."</td><td>".$dd."</td><td>".$ns."</td><td>".$ds."</td></tr></table>";
    
            echo " <table><thead><td>Station</td><td>Arrival_Time</td><td>Departure_Time</td><td>Distance</td></thead>";
            echo " <tr><td>".$sp."</td><td>".$st."</td><td>".$st."</td><td>0</td></tr>";
    
            echo "<form action=\"insert_into_train_4.php\" method=\"post\">";
            $temp = 1;
            while ($temp <= $ns) {
                echo " <tr><td><select id=\"stn".$temp."\" name=\"stn".$temp."\"required> ";
    
                $cdquery = "SELECT sname FROM station";
                $cdresult = mysqli_query($conn, $cdquery);
    
                echo " <option value = \"\" > </option>";
    
                while ($cdrow = mysqli_fetch_array($cdresult)) {
                    $cdTitle = $cdrow['sname'];
                    echo " <option value = \"$cdTitle\" > $cdTitle </option>";
                }
    
                echo "
                </select></td>
                <td><input type=\"text\" name=\"st".$temp."\" required></td>
                <td><input type=\"text\" name=\"dt".$temp."\" required></td>
                <td><input type=\"text\" name=\"ds".$temp."\" required></td>    
                </tr>";
                $temp += 1;
            }
    
            echo " <tr><td>".$dp."</td><td>".$dt."</td><td>".$dt."</td><td>".$ds."</td></tr></table>";    
            echo "<input type=\"submit\">";
        } else {
            echo "
            <form action=\"insert_into_train_3.php\" method=\"post\">
            <table>
            <tr><td>Train Name </td><td> <input type=\"text\" name=\"tname\" required></td></tr>
            <tr><td>Starting Point </td><td> <select id=\"sp\" name=\"sp\" required>";
    
            $cdquery = "SELECT sname FROM station";
            $cdresult = mysqli_query($conn, $cdquery);
    
            while ($cdrow = mysqli_fetch_array($cdresult)) {
                $cdTitle = $cdrow['sname'];
                echo " <option value = \"$cdTitle\" > $cdTitle </option>";
            }
    
            echo "</select></td></tr>
    
            <tr><td>Starting Time </td><td> <input type=\"time\" name=\"st\" required></td></tr>
    
            <tr><td>Destination Point </td><td> <select id=\"dp\" name=\"dp\" required>";
    
            $cdquery = "SELECT sname FROM station";
            $cdresult = mysqli_query($conn, $cdquery);
    
            while ($cdrow = mysqli_fetch_array($cdresult)) {
                $cdTitle = $cdrow['sname'];
                echo " <option value = \"$cdTitle\" > $cdTitle </option>";
            }
    
            echo "</select></td></tr>
    
            <tr><td>Destination Time </td><td> <input type=\"time\" name=\"dt\" required></td></tr>
    
            <tr><td>Distance </td><td> <input type=\"text\" name=\"ds\" required></td></tr>
    
            <tr><td>No Of Intermediate stations</td><td><input type=\"text\" name=\"ns\" required></td></tr>
    
            <tr><td>Day of Arrival </td><td> <input type=\"text\" name=\"dd\" required></td></tr>
            </table>
            <input type=\"submit\" value=\"Enter Train Details\">";
        }
    
        echo "<br> <a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";
    
        ?>
    </div>
</body>
</html>
