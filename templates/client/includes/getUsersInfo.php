<?php
include("../../includes/config.php");  // Assurez-vous que cette inclusion est nécessaire

// Obtenez l'ID de l'utilisateur à partir de la session
$userID = $_SESSION['user_id'];

// Exécutez une requête pour récupérer le prénom, le nom et le rôle de l'utilisateur
$sql = "SELECT * FROM users WHERE id_users = '$userID'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $role = $row['Role'];

} else {
    // Gérez le cas où l'utilisateur n'a pas été trouvé dans la base de données
    echo "Utilisateur introuvable.";
}

?>