<!DOCTYPE html>
<html>
<head>
    <style>
        /* Your existing CSS styles */
        .content-box {
            width: 400px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        body {
            background-image: url('userlogin.jpg');
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }
        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        select {
            border-radius: 5px;
        }
        input[type="date"], input[type="submit"] {
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Header and Footer Styles */
        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ticket Booking</h1>
    </header>

    <div class="main-content">
        <div class="content-box">
            <form action="enquiry_result.php" method="post">
                <div style="color: white;">
                    Starting Point: 
                    <select id="sp" name="sp" required>
                        <?php
                        require "db.php";
                        $cdquery="SELECT sname FROM station";
                        $cdresult=mysqli_query($conn,$cdquery);
                        echo "<option value=\"\"> </option>";
                        while ($cdrow=mysqli_fetch_array($cdresult)) {
                            $cdTitle=$cdrow['sname'];
                            echo "<option value=\"$cdTitle\">$cdTitle</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    Destination Point: 
                    <select id="dp" name="dp" required>
                        <?php
                        $cdquery="SELECT sname FROM station";
                        $cdresult=mysqli_query($conn,$cdquery);
                        echo "<option value=\"\"> </option>";
                        while ($cdrow=mysqli_fetch_array($cdresult)) {
                            $cdTitle=$cdrow['sname'];
                            echo "<option value=\"$cdTitle\">$cdTitle</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    Date of Journey: 
                    <input type="date" name="doj" required><br><br>
                    <div style="color: white;">
                    </div>
                    <input type="submit">
                </div>
            </form>
            <br><br>
            <a href="http://localhost/railway/index.htm">Go to Home Page!!!</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 RAILWAY MANAGEMENT SYSTEM</p>
    </footer>
</body>
</html>
s