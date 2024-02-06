<?php
// Connexion à la base de données (à remplacer par vos propres informations)
include("../../../includes/config.php");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fonction pour nettoyer les données de l'utilisateur
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer les données de l'utilisateur
    $lastname = sanitizeInput($_POST["lastname"]);
    $firstname = sanitizeInput($_POST["firstname"]);
    $email = sanitizeInput($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hasher le mot de passe pour des raisons de sécurité

    // Requête préparée pour insérer des données dans la table 'users'
    $sql = $conn->prepare("INSERT INTO users (FirstName, LastName, Mail, Password, Role) VALUES (?, ?, ?, ?, 'Guest')");
    $sql->bind_param("ssss", $firstname, $lastname, $email, $password);

    // Exécuter la requête
    if ($sql->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $sql->error;
    }

    // Fermer la connexion
    $sql->close();
    $conn->close();
}
?>
