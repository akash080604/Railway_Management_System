<?php
// Include the database connection file
require "db.php";

// Function to sanitize user inputs
function sanitizeInput($input) {
    // You can implement your sanitization logic here
    // For now, let's just trim the input
    $input = trim($input);
    // You might want to do more sanitization like htmlentities() or mysqli_real_escape_string() depending on your requirements
    return $input;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $pwd = sanitizeInput($_POST["password"]);
    $eid = sanitizeInput($_POST["email"]);
    $mno = sanitizeInput($_POST["mobile"]);
    $dob = sanitizeInput($_POST["dob"]);

    // Prepare and bind the statement
    $sql = "INSERT INTO user (password, emailid, mobileno, dob) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $pwd, $eid, $mno, $dob);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a success page
        header("Location: success.php");
        exit();
    } else {
        // Display error message and provide a link to go back to registration form
        echo "Error: " . $conn->error . "<br><a href=\"http://localhost/railway/new_user_form.htm\">Go Back to Registration</a>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
