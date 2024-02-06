<?php
session_start();

include("../../../includes/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $live_values = $_POST["live_values"];
    $salle = $_POST["salle"];
    $enterprise_id = $_SESSION['id_enterprise'];

    // Vérifier si le capteur avec le même nom et la même salle existe déjà
    $check_query = "SELECT * FROM sensors WHERE name = '$name' AND room = '$salle' AND id_enterprise = $enterprise_id";
    $result = $conn->query($check_query);

    if ($result->num_rows == 0) {
        // Le capteur n'existe pas, on peut l'ajouter
        $query = "INSERT INTO sensors (name, live_values, status, room, id_enterprise) VALUES ('$name', '$live_values', 'ON', '$salle', $enterprise_id)";

        if ($conn->query($query) === TRUE) {
            echo "Ajout du capteur réussi";
        } else {
            echo "Erreur lors de l'ajout du capteur : " . $conn->error;
        }
    } else {
        // Le capteur existe déjà, afficher un message d'erreur
        echo "Un capteur avec le même nom dans la même salle existe déjà.";
    }
}
?>
