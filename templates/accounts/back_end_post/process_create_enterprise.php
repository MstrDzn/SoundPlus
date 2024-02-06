<?php
include("../../../includes/config.php");
session_start();

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to sanitize user input
function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = sanitizeInput($_POST["name"]);

    // Generate a random password of length 12 characters using a stronger method
    $randomPassword = bin2hex(random_bytes(6)); // 6 bytes = 12 characters

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO enterprises (name, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $randomPassword);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Get the ID of the newly inserted enterprise
        $enterpriseId = mysqli_insert_id($conn);

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Check if the enterprise ID exists in the 'enterprises' table using prepared statement
            $checkEnterpriseSql = "SELECT * FROM enterprises WHERE id_enterprise = ?";
            $checkStmt = mysqli_prepare($conn, $checkEnterpriseSql);
            mysqli_stmt_bind_param($checkStmt, "i", $enterpriseId);
            mysqli_stmt_execute($checkStmt);
            $result = mysqli_stmt_get_result($checkStmt);

            if (mysqli_num_rows($result) > 0) {
                // Update the user's enterprise ID using prepared statement
                $updateUserSql = "UPDATE users SET id_enterprise = ?, role = 'Owner' WHERE id_users = ?";
                $updateStmt = mysqli_prepare($conn, $updateUserSql);
                mysqli_stmt_bind_param($updateStmt, "ii", $enterpriseId, $userId);

                if (mysqli_stmt_execute($updateStmt)) {
                    echo "Enterprise created successfully!<br>";
                    echo "User's enterprise ID updated successfully!<br>";
                    echo "Random password for the enterprise: $randomPassword";
                } else {
                    echo "Error updating user's enterprise ID: " . mysqli_error($conn) . "<br>";
                    echo "Failed SQL query: $updateUserSql";
                }
            } else {
                echo "Error: Enterprise ID $enterpriseId not found in the 'enterprises' table.<br>";
            }
        } else {
            echo "User ID not set in the session.<br>";
            var_dump($_SESSION); // Output the contents of the session for debugging
        }
    } else {
        echo "Error creating enterprise: " . mysqli_error($conn) . "<br>";
        echo "Failed SQL query: $sql";
    }

    // Close the connection
    mysqli_close($conn);
}
?>
