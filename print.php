<?php
session_start();
require "db.php";

// Check if PNR is provided
if(isset($_GET['pnr'])) {
    $pnr = $_GET['pnr'];

    // Query to get reservation details
    $query = mysqli_query($conn, "SELECT * FROM resv WHERE pnr = '$pnr'");
    
    // Fetch reservation details
    if($row = mysqli_fetch_array($query)) {
        $trainno = $row['trainno'];
        $doj = $row['doj'];
        $tfare = $row['tfare'];
        $class = $row['class'];
        $nos = $row['nos'];
        $status = $row['status'];

        // Query to get passenger details
        $passenger_query = mysqli_query($conn, "SELECT * FROM pd WHERE pnr = '$pnr'");
        $passenger_details = '';
        while($passenger = mysqli_fetch_array($passenger_query)) {
            $passenger_name = $passenger['pname'];
            $passenger_age = $passenger['page'];
            $passenger_gender = $passenger['pgender'];

            $passenger_details .= '
                <tr>
                    <td>'.$passenger_name.'</td>
                    <td>'.$passenger_age.'</td>
                    <td>'.$passenger_gender.'</td>
                </tr>';
        }

        // Query to get train details
        $train_query = mysqli_query($conn, "SELECT * FROM train WHERE trainno = '$trainno'");
        $train_details = mysqli_fetch_array($train_query);
        $train_name = $train_details['tname'];
        $starting_point = $train_details['sp'];
        $arrival_time = $train_details['st'];
        $destination_point = $train_details['dp'];
        $departure_time = $train_details['dt'];

        // Format the invoice layout
        $invoice_content = '
            <div style="width: 600px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h2 style="text-align: center; margin-bottom: 20px;">Invoice</h2>
                <div>
                    <p><strong>PNR:</strong> '.$pnr.'</p>
                    <p><strong>Train Number:</strong> '.$trainno.'</p>
                    <p><strong>Train Name:</strong> '.$train_name.'</p>
                    <p><strong>Starting Point:</strong> '.$starting_point.'</p>
                    <p><strong>Arrival Time:</strong> '.$arrival_time.'</p>
                    <p><strong>Destination Point:</strong> '.$destination_point.'</p>
                    <p><strong>Departure Time:</strong> '.$departure_time.'</p>
                    <p><strong>Date of Journey:</strong> '.$doj.'</p>
                    <p><strong>Total Fare:</strong> '.$tfare.'</p>
                    <p><strong>Class:</strong> '.$class.'</p>
                    <p><strong>Seats Reserved:</strong> '.$nos.'</p>
                    <p><strong>Status:</strong> '.$status.'</p>
                </div>
                <br>
                <table style="width: 100%; border-collapse: collapse; margin: 0 auto;">
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">Passenger Name</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Age</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Gender</th>
                    </tr>
                    '.$passenger_details.'
                </table>
                <br>
                <button onclick="window.print()" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Print Invoice</button>
            </div>
        ';

        // Display the styled invoice
        echo $invoice_content;
    } else {
        echo "Invoice not found.";
    }
} else {
    echo "PNR not provided.";
}

$conn->close();
?>
