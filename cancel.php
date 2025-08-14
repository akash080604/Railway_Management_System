<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url('pnglogin.jpeg');
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .content-box {
            width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: black;
        }
        .link {
            color: black;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    require "db.php";

    if(isset($_POST["cancpnr"])) {
        $pnr = $_POST["cancpnr"];
        $uid = $_SESSION["id"];

        $sql = "UPDATE resv SET status ='CANCELLED' WHERE pnr='$pnr' AND id='$uid'";

        if ($conn->query($sql) === TRUE) {
            echo "<div class=\"content-box\">";
            echo "<p>Cancellation Successful!!!</p>";
        } else {
            echo "<div class=\"content-box\">";
            echo "<p>Error: " . $conn->error . "</p>";
        }

        echo "<br><br><div><a class=\"link\" href=\"http://localhost/railway/index.htm\">Home Page</a></div><br>";
        echo "</div>"; // closing content-box div
    } else {
        echo "<div class=\"content-box\">";
        echo "<p>PNR not provided.</p>";
        echo "<br><br><div><a class=\"link\" href=\"http://localhost/railway/index.htm\">Home Page</a></div><br>";
        echo "</div>"; // closing content-box div
    }

    $conn->close();
    ?>
</body>
</html>
