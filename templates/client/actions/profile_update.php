<?php
// Connexion à la base de données (à remplacer par vos propres informations)
include("../../../includes/config.php");

session_start();

$userID = $_SESSION['user_id'];

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fonction pour nettoyer les données de l'utilisateur
function sanitizeInput($data) {
    return trim(htmlspecialchars($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer les données de l'utilisateur
    $lastname = sanitizeInput($_POST["lastname"]);
    $firstname = sanitizeInput($_POST["firstname"]);
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier que les deux mots de passe sont identiques
    if (!password_verify($confirmpassword, $hashed_password)) {
        echo "Mdp != CMdp ";
    } else {
        // Requête SQL pour mettre à jour les données de l'utilisateur
        $sql = "UPDATE users SET LastName='$lastname', FirstName='$firstname', Mail='$email', Password='$hashed_password' WHERE id_users = '$userID'";

        // Exécuter la requête
        if ($conn->query($sql) === TRUE) {
            echo "Mise à jour réussie !";
        } else {
            echo "Erreur : " . $conn->error;
        }

    }

    // Fermer la connexion
    $conn->close();
}
?>
