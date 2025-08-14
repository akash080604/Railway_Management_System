<!DOCTYPE html>
<html>
<head>
    <style>
        .content-box {
            width: 1200px;
            margin: 0 auto; /* Center the content box horizontally */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        body {
            background-image: url('admin.jpg');
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
        require "db.php";

        $cdquery = "SELECT * FROM user";
        $cdresult = mysqli_query($conn, $cdquery);

        echo "<table>
        <thead><tr><td>Id</td><td>Email_Id</td><td>Password</td><td>Mobile_no</td><td>Date_Of_Birth</td><td></td><td></td></tr></thead>";

        while ($cdrow = mysqli_fetch_array($cdresult)) {
            echo "<tr><td>".$cdrow[0]."</td><td>".$cdrow[1]."</td><td>".$cdrow[2]."</td><td>".$cdrow[3]."</td><td>".$cdrow[4]."</td><td><a href=\"http://localhost/railway/edit_user.php?id=".$cdrow[0]."\"><button>Edit</button></a></td><td><a href=\"http://localhost/railway/delete_user.php?id=".$cdrow[0]."\"><button>Delete</button></a></td></tr>";
        }
        echo "</table>";

        echo " <br><a href=\"http://localhost/railway/new_user_form.html\"> Add New User </a><br> ";
        echo " <br><a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";
        ?>
    </div>
</body>
</html>
