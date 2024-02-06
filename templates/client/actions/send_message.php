<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiverId = $_POST["receiver_id"];
    $messageContent = $_POST["message"];

    include("../../../includes/config.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Échapper les valeurs pour éviter les injections SQL (utilisation de requêtes préparées serait encore mieux)
    $receiverId = mysqli_real_escape_string($conn, $receiverId);
    $messageContent = mysqli_real_escape_string($conn, $messageContent);

    // Utilisation de sessions - assurez-vous que la session est démarrée et que $_SESSION['user_id'] est correctement défini
    session_start();

    // Insérer le message dans la base de données en utilisant une requête préparée
    $sql = "INSERT INTO messages (sender_id, receiver_id, message_content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        $userId = $_SESSION['user_id'];  // Stocker la valeur de la session dans une variable séparée
        mysqli_stmt_bind_param($stmt, "iss", $userId, $receiverId, $messageContent);

        if (mysqli_stmt_execute($stmt)) {
            echo "Message envoyé avec succès!";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Erreur lors de l'envoi du message: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur de préparation de la requête: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Erreur de requête HTTP.";
}
?>
