<?php
session_start();

// Détruire toutes les données de session
session_destroy();
setcookie('user_id', '', time() - 3600, '/'); // Remplacez 'user_id' par le nom de votre cookie

// Rediriger vers la page d'accFueil ou une autre page après la déconnexion
header("Location: ../index.php"); // Remplacez "index.php" par le chemin de la page souhaitée
exit();
?>
