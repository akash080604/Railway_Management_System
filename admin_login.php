<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-image: url(adminlogin.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .content-box {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-box form {
            display: flex;
            flex-direction: column;
        }

        .content-box input {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .content-box input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .content-box input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .content-box a {
            color: #007bff;
            text-decoration: none;
        }

        .content-box a:hover {
            text-decoration: underline;
        }

        .center {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="content-box">
        <div class="center">
            <h2 style="color: #333;">Admin Login</h2>
        </div>
        <?php 
        session_start();

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["uid"]) && isset($_POST["password"])) {
                if($_POST["uid"] == 'admin' && $_POST["password"] == 'admin') {
                    $_SESSION["admin_login"] = true;
                }
            }
        }

        // Check if admin is logged in
        if(isset($_SESSION["admin_login"]) && $_SESSION["admin_login"] === true) {
            echo "
            <a href=\"http://localhost/railway/insert_into_stations.php\">Show All Stations</a><br>
            <a href=\"http://localhost/railway/show_trains.php\">Show All Trains</a><br>
            <a href=\"http://localhost/railway/show_users.php\">Show All Users</a><br>
            <a href=\"http://localhost/railway/insert_into_train_3.php\">Enter New Train</a><br>
            <a href=\"http://localhost/railway/insert_into_classseats_3.php\">Enter Train Schedule</a><br>
            <a href=\"http://localhost/railway/booked.php\">View all booked tickets</a><br>
            <a href=\"http://localhost/railway/cancelled.php\">View all cancelled tickets</a><br>
            <a href=\"http://localhost/railway/logout.php\">Logout</a><br>
            ";
        } else {
            echo "
            <form action=\"admin_login.php\" method=\"post\">
            User ID: <input type=\"text\" name=\"uid\" required><br>
            Password: <input type=\"password\" name=\"password\" required><br>
            <input type=\"submit\" value=\"Login\">
            </form>
            ";
        }
        ?>
        <div class="center">
            <br><a href="http://localhost/railway/index.htm">Go to Home Page!!!</a>
        </div>
    </div>
</body>
</html>
