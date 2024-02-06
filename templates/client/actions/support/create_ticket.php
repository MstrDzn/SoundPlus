<?php
session_start();

include("../../../../includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $userId = $_SESSION['user_id'];

    // Vérifier si l'utilisateur a déjà un ticket en cours (statut "In Progress")
    $checkInProgressQuery = "SELECT * FROM tickets WHERE id_user = $userId AND status = 'In Progress'";
    $checkInProgressResult = $conn->query($checkInProgressQuery);

    if ($checkInProgressResult->num_rows > 0) {
        echo "Vous avez déjà un ticket en cours (statut 'In Progress'). Vous ne pouvez en créer qu'un à la fois.";
    } else {
        // Requête pour ajouter un nouveau ticket
        $query = "INSERT INTO tickets (subject, description, status, id_user) VALUES ('$subject', '$description', 'In Progress', $userId)";

        if ($conn->query($query) === TRUE) {
            echo "Nouveau ticket ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du ticket : " . $conn->error;
        }
    }
}
?>