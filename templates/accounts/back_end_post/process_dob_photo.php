<?php
// Include your database connection file or configure it here
include("../../../includes/config.php");

session_start();

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $dob = sanitizeInput($_POST["dob"]);

    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Update the user's date of birth in the database
        $updateSql = "UPDATE users SET BirthDate = '$dob' WHERE id_users = $userId";
        
        if (mysqli_query($conn, $updateSql)) {
            echo "success"; 
        } else {
            echo "Error updating user data: " . mysqli_error($conn);
        }
    } else {
        echo "User not logged in.";
    }

    // Close the connection
    mysqli_close($conn);
}
?>
