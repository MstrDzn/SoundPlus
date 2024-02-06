<?php
include("../../../includes/config.php");
session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE Mail = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            if (password_verify($password, $row['Password'])) {
                // Set a cookie for persistent login
                $cookie_name = "user_id";
                $cookie_value = $row['id_users'];
                setcookie($cookie_name, $cookie_value, time() + (30 * 24 * 60 * 60), "/"); // 30 days expiration

                $_SESSION['user_id'] = $row['id_users'];
                $_SESSION['id_enterprise'] = $row['id_enterprise'];
                $_SESSION['Role'] = $row['Role'];

                if ($_SESSION['Role'] == 'Admin') {
                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    header("Location: ../../client/dashboard.php");
                    exit();
                }
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
