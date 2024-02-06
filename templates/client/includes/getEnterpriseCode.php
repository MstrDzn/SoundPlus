<?php
    session_start();

    include("../../includes/config.php"); 

    $id_enterprise = $_SESSION['id_enterprise'];

    $sql = "SELECT * FROM enterprises WHERE id_enterprise = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_enterprise);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result) {
        $row = $result->fetch_assoc();
        $passwordName = $row['password'];
        echo "Enterprise password :" . $passwordName;
    } else {
        echo "Erreur de requête : " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
    

?>
