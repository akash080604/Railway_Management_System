<!DOCTYPE html>
<html>
<head>
    <style>
        .content-box {
            width: 400px;
            margin: 20px auto; /* Center the content box horizontally with a bit of top margin */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body style="background-image: url(admin.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">

<div class="content-box">

    <?php
    require "db.php";

    $cdquery = "SELECT id, sname FROM station";
    $cdresult = mysqli_query($conn, $cdquery);
    echo "
    <table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Station</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    ";

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        $cdId = $cdrow['id'];
        $cdTitle = $cdrow['sname'];
        echo "
        <tr>
            <td>$cdId</td>
            <td>$cdTitle</td>
            <td><a href=\"http://localhost/railway/edit_station.php?id=".$cdId."\"><button>Edit</button></a></td>
            <td><a href=\"http://localhost/railway/delete_station.php?id=".$cdId."\"><button>Delete</button></a></td>
        </tr>
        ";
    }
    echo "</table>";
    ?>

    <br>

    <form action="insert_into_station.php" method="post">
        Add Station : <input type="text" name="sname" placeholder="New Station" required>
        <input type="submit" value="Add">
    </form>

    <?php
    echo "<br><br> <a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";
    ?>

</div> <!-- Closing content-box div -->

</body>
</html>
