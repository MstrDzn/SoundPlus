<?php
// Informations de connexion à la base de données
define('SERVEUR', 'localhost');
define('UTILISATEUR', 'root');
define('MOT_DE_PASSE', '');
define('BASE_DE_DONNEES', 'soundplus4');

// Connexion à la base de données
$conn = mysqli_connect(SERVEUR, UTILISATEUR, MOT_DE_PASSE, BASE_DE_DONNEES, null);

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
?>
