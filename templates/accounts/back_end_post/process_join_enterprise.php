<?php
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
    $password = sanitizeInput($_POST["password"]);

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT id_enterprise FROM enterprises WHERE password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $numRows = mysqli_num_rows($result);

        if ($numRows > 0) {
            // Password is valid, fetch the enterprise ID
            $row = mysqli_fetch_assoc($result);
            $enterpriseId = $row['id_enterprise'];

            // Update the user's enterprise ID in the 'users' table
            $userId = $_SESSION['user_id']; // Assuming you have a user session
            $updateUserSql = "UPDATE users SET id_enterprise = ? WHERE id_users = ?";
            $updateUserStmt = mysqli_prepare($conn, $updateUserSql);
            mysqli_stmt_bind_param($updateUserStmt, "ii", $enterpriseId, $userId);

            if (mysqli_stmt_execute($updateUserStmt)) {
                echo "Successfully joined the enterprise!";
            } else {
                echo "Error updating user's enterprise ID: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
