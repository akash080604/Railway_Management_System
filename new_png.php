<html>
<head>
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

<?php 
session_start();
require "db.php";

$pname=$_POST["pname"];
$page=$_POST["page"];
$pgender=$_POST["pgender"];

$tno=$_SESSION["tno"];
$doj=$_SESSION["doj"];
$sp=$_SESSION["sp"];
$dp=$_SESSION["dp"];
$class=$_SESSION["class"];

$query="SELECT fare FROM classseats WHERE trainno='".$tno."' AND class='".$class."' AND doj='".$doj."' AND sp='".$sp."' AND dp='".$dp."'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));

$row=mysqli_fetch_array($result);
$fare=$row[0];

$tempfare=0;
$temp=0;

for($i=0; $i<$_SESSION["nos"]; $i++) {
    if($page[$i]>=18) {
        $temp++;
        $tempfare+=$fare;
    } elseif($page[$i]<18) {
        $tempfare+=0.5*$fare;
    } elseif($page[$i]>=60) {
        $tempfare+=0.5*$fare;
    }
}

if($temp==0) {
    echo "<br><br>At least one adult must accompany!!!";
    echo "<br><br><a href=\"http://localhost/railway/enquiry.php\">Back to Enquiry</a><br>";
    die();
}

echo '<span style="color: white;">Total fare is Rs.'.$tempfare.'/-</span>';

$sql = "INSERT INTO resv(id, trainno, sp, dp, doj, tfare, class, nos) VALUES ('".$_SESSION["id"]."','".$_SESSION["tno"]."','".$_SESSION["sp"]."','".$_SESSION["dp"]."','".$_SESSION["doj"]."','".$tempfare."','".$_SESSION["class"]."','".$_SESSION["nos"]."')";
if ($conn->query($sql) === TRUE) {
    echo "<br><br>Reservation Successful";
} else {
    if ($conn->errno == 1062) {
        echo '<br><br><span style="color: white;">Record already exists!</span>';
    } else {
        echo "<br><br>Error: " . $conn->error;
    }
}

$tid=$_SESSION["id"];
$ttno=$_SESSION["tno"];
$tdoj=$_SESSION["doj"];

$query="SELECT pnr FROM resv WHERE id='".$tid."' AND trainno='".$ttno."' AND doj='".$tdoj."'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));

$row=mysqli_fetch_array($result);
$rpnr=$row['pnr'];

$tpname=$_POST['pname'];
$tpage=$_POST["page"];
$tpgender=$_POST["pgender"];

for($i=0; $i<$_SESSION["nos"]; $i++) {
    $check_query = "SELECT * FROM pd WHERE pnr='".$rpnr."' AND pname='".$tpname[$i]."' AND page='".$tpage[$i]."' AND pgender='".$tpgender[$i]."'";
    $check_result = mysqli_query($conn, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        echo '<br><br><span style="color: white;">Passenger details for '.$tpname[$i].' already added!</span>';
    } else {
        $sql = "INSERT INTO pd(pnr, pname, page, pgender) VALUES  ('".$rpnr."','".$tpname[$i]."','".$tpage[$i]."','".$tpgender[$i]."')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<br><br>Passenger details added!!!";
        } else {
            echo "<br><br>Error: " . $conn->error;
        }
    }
}

echo "<br><br><a href=\"http://localhost/railway/index.htm\">Go Back!!!</a><br>";

$conn->close(); 
?>

</div> <!-- End of content-box -->

</body>
</html>
