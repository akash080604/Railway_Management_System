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
            background-image: url(admin.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0; /* Remove default margin */
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

    $cdquery = "SELECT * FROM train";
    $cdresult = mysqli_query($conn, $cdquery);
    echo "
    <table>
        <thead>
            <tr>
                <td>Train_no</td>
                <td>Train_name</td>
                <td>Starting_Point</td>
                <td>Arrival_Time</td>
                <td>Destination_Point</td>
                <td>Departure_Time</td>
                <td>Day</td>
                <td>Distance</td>
                <td></td>
            </tr>
        </thead>
    ";

    while ($cdrow = mysqli_fetch_array($cdresult)) {
        echo "
        <tr>
            <td>".$cdrow['trainno']."</td>
            <td>".$cdrow['tname']."</td>
            <td>".$cdrow['sp']."</td>
            <td>".$cdrow['st']."</td>
            <td>".$cdrow['dp']."</td>
            <td>".$cdrow['dt']."</td>
            <td>".$cdrow['dd']."</td>
            <td>".$cdrow['distance']."</td>
            <td><a href=\"http://localhost/railway/schedule.php?trainno=".$cdrow['trainno']."\"><button>Schedule</button></a></td>
        </tr>
        ";
    }
    echo "</table>";

    echo " <br><a href=\"http://localhost/railway/insert_into_train_3.php\"> Add New Train </a><br> ";
    echo " <br><a href=\"http://localhost/railway/admin_login.php\">Go Back to Admin Menu!!!</a> ";
    ?>

</div>

</body>
</html>
