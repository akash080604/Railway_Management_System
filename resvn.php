<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url(pnglogin.jpeg);
            height: 100vh;
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

<div class="content-box">
    <form action="new_png.php" method="post">

        <?php
        session_start();
        require "db.php";

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $mobile = $_POST["mno"];
        $pwd = $_POST["password"];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE user.mobileno=$mobile AND user.password='" . $pwd . "' ") or die(mysql_error());
        if (mysqli_num_rows($query) == 0) {
            echo "No such login !!! <br> ";
            echo " <br><a href=\"http://localhost/railway/enquiry_result.php\">Go Back!!!</a> <br>";
            die();
        }

        $row = mysqli_fetch_array($query);
        $temp = $row['id'];
        $_SESSION["id"] = "$temp";
        $tno = $_POST["tno"];
        $_SESSION["tno"] = "$tno";
        $class = $_POST["class"];
        $_SESSION["class"] = "$class";
        $nos = $_POST["nos"];
        $_SESSION["nos"] = "$nos";

        echo "<table>";

        for ($i = 0; $i < $nos; $i++) {
            echo "<tr><td><input type='text' name='pname[]' placeholder=\"Passenger Name\" required></td><br> ";
            echo "<td><input type='text' name='page[]' placeholder=\"Passenger Age\" required></td><br>";
            echo "<td><input type='text' name='pgender[]' placeholder=\"Passenger Gender\" required></td></tr><br> ";
        }

        echo "</table>";

        echo "<a href=\"http://localhost/railway/enquiry.php\">Back to Enquiry</a>";

        $conn->close();
        ?>

        <br><br><input type="submit" value="Book">
    </form>
</div>

</body>
</html>
