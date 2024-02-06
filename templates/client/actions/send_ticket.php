<?php
session_start();
// Inclure le fichier de configuration
include("../../../includes/config.php");

// Vérifier la connexion à la base de données
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $ticketId = htmlspecialchars($_POST['id_ticket']);
    $receiverId = htmlspecialchars($_POST['receiver_id']);
    $messageContent = htmlspecialchars($_POST['message']);

    // Récupérer l'ID de l'utilisateur envoyant le message (vous pouvez ajuster ceci en fonction de votre logique d'authentification)
    $senderId = $_SESSION['user_id']; // Remplacez 1 par l'ID de l'utilisateur actuellement connecté

    // Insérer le message dans la table tickets_message
    $sqlInsertMessage = "INSERT INTO tickets_message (id_ticket, sender_id, receiver_id, message_content) VALUES (?, ?, ?, ?)";
    $stmtInsertMessage = mysqli_prepare($conn, $sqlInsertMessage);

    mysqli_stmt_bind_param($stmtInsertMessage, "iiis", $ticketId, $senderId, $receiverId, $messageContent);
    mysqli_stmt_execute($stmtInsertMessage);

    // Vérifier si l'insertion a réussi
    if (mysqli_stmt_affected_rows($stmtInsertMessage) > 0) {
        echo "Message envoyé avec succès.";
        header("Location: " . $_SERVER['HTTP_REFERER']);

    } else {
        echo "Erreur lors de l'envoi du message.";
        header("Location: " . $_SERVER['HTTP_REFERER']);

    }

    // Fermer le statement
    mysqli_stmt_close($stmtInsertMessage);
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
