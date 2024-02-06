<?php
// Obtenez la langue à partir des paramètres d'URL, des cookies, etc.
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Chargez le fichier de langue correspondant
$translations = include "../../lang/$lang.php";

// Si le formulaire est soumis, mettez à jour la langue
if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $translations = include "../../lang/$lang.php";
}

session_start();
if (!isset($_SESSION['user_id'])) {
    // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: ../accounts/loginold.php");
    exit;
}
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

    } else {
        // Gérez le cas où l'utilisateur n'a pas été trouvé dans la base de données
        echo "Utilisateur introuvable.";
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Montserrat:ital,wght@0,100;0,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="../static/images/favicon.png" />
    <link rel="stylesheet" href="includes/navigations/navigations.css">
    <link rel="stylesheet" href="css/support.css">

    <title><?php echo $translations['dashboard_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Support</h1>
        <ul id="menu">
            <li><a class="active" href="#" onclick="changeSection(event,'support')">Overview</a></li>
            <li><a href="#" onclick="changeSection(event,'tickets')">Tickets</a></li>
        </ul>

        <section id="support" class="support_containers">
            <div class="support_sub_containers">
                <div class="button_containers">
                    <button onclick="openPopup()" class="add"><i class="fa-solid fa-plus fa-lg"></i> Create ticket</button><br>

                </div>
                <?php
                session_start();
                include("../../includes/config.php");

                // Requête pour obtenir les tickets de l'utilisateur actuel
                $userID = $_SESSION['user_id'];
                $checkQuery = "SELECT * FROM tickets WHERE id_user = '$userID'";
                $checkResult = $conn->query($checkQuery);

                if ($checkResult->num_rows > 0) {
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Ticket</th>
                                <th>Sujet</th>
                                <th>Description</th>
                                <th>Statut</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $checkResult->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row["id_ticket"]; ?></td>
                                    <td><?php echo $row["subject"]; ?></td>
                                    <td><?php echo $row["description"]; ?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td><a style='display: inline-block; margin-right:5px;' href=''onclick="changeSection(event,'tickets')" ><i class="fa-solid fa-eye fa-lg"></i></a> <a style='display: inline-block;' href=''><i class="fa-solid fa-circle-xmark fa-lg"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "No tickets found.";
                }

                // Fermeture de la requête
                $checkResult->close();
                ?>
            </div>
        </section>

        <section id="tickets" class="tickets_containers">
        <div class="container">
            <div class="chat_box">
            <?php
            // Inclure le fichier de configuration
            include("../../includes/config.php");

            // Vérifier la connexion à la base de données
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fonction pour récupérer les informations de l'utilisateur
            function getUserInfo($conn, $userId) {
                $sql = "SELECT FirstName, LastName FROM users WHERE id_users = ?";
                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param($stmt, "i", $userId);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    $userInfo = mysqli_fetch_assoc($result);
                    return $userInfo;
                } else {
                    return array('FirstName' => 'Utilisateur', 'LastName' => 'Inconnu');
                }
            }
            $userID = $_SESSION['user_id'];

            // Récupérer les informations du ticket en cours avec le statut "Progress"
            $sqlTicket = "SELECT id_ticket, subject, id_user FROM tickets WHERE id_user = '$userID' AND status = 'In Progress' LIMIT 1";
            $resultTicket = mysqli_query($conn, $sqlTicket);

            if ($resultTicket && mysqli_num_rows($resultTicket) > 0) {
                $ticketInfo = mysqli_fetch_assoc($resultTicket);
                $selectedTicketId = $ticketInfo['id_ticket'];
                $selectedUserId = $ticketInfo['id_user'];

                echo '<h2 style="margin-bottom:10px;">' . $ticketInfo['subject'] . '</h2>';

                // Afficher les messages pour l'utilisateur associé au ticket
                $sqlMessages = "SELECT sender_id, receiver_id, message_content FROM tickets_message WHERE id_ticket = ?";
                $stmtMessages = mysqli_prepare($conn, $sqlMessages);

                mysqli_stmt_bind_param($stmtMessages, "i", $selectedTicketId);
                mysqli_stmt_execute($stmtMessages);

                $resultMessages = mysqli_stmt_get_result($stmtMessages);
                echo '<div class="message_box">';

                if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
                    while ($rowMessages = mysqli_fetch_assoc($resultMessages)) {
                        $senderInfo = getUserInfo($conn, $rowMessages['sender_id']);
                        $receiverInfo = getUserInfo($conn, $rowMessages['receiver_id']);
                        $messageClass = ($rowMessages['sender_id'] == $selectedUserId) ? 'sent' : 'received';

                        echo '<div class="message ' . $messageClass . '">';
                        echo '<p>' . $senderInfo['FirstName'] . ' ' . $senderInfo['LastName'] . ':<br><br> ' . $rowMessages['message_content'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucun message trouvé.</p>';
                }
                echo '</div>';

                // Formulaire pour envoyer un message
                echo '<form method="post" action="actions/send_ticket.php">';
                echo '<input type="hidden" name="id_ticket" value="' . $selectedTicketId . '">';
                echo '<input type="hidden" name="receiver_id" value="' . $selectedUserId . '">';
                echo '<div class="textarea_box">';
                echo '<input type="text" name="message" id="message" rows="4" cols="50 >';
                echo '<button class="send" type="submit"><i class="fa-solid fa-paper-plane fa-lg"></i></button>';
                echo '</div>';
                echo '</form>';
            } else {
                echo '<p>Aucun ticket en cours avec le statut "In Progress" trouvé.</p>';

            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
            ?>
            </div>
        </div>
        </section>


    </main>



    <div id="popup">

        <form method="post" action="actions/support/create_ticket.php">
            Sujet : <input type="text" required name="subject"><br>
            Description : <br> <textarea required name="description"></textarea><br>
            <input type="submit" value="Soumettre le ticket">
        </form>
        <button onclick="closePopup()">Fermer</button>
    </div>

    <!-- Fond semi-transparent derrière le popup -->
    <div id="overlay"></div>


</body>
</html>


<script>
    // Fonction pour afficher le popup
    function openPopup() {
        document.getElementById('popup').style.display = 'flex';
        document.getElementById('overlay').style.display = 'block';
    }

    // Fonction pour fermer le popup
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
</script>

<script>
    function changeSection(event, sectionId) {
        event.preventDefault();
        document.getElementById('support').style.display = 'none';
        document.getElementById('tickets').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
    }

    document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez l'élément avec la classe "message_box"
    var messageBox = document.querySelector(".message_box");

    // Réglez la propriété scrollTop sur la hauteur totale de l'élément pour le faire défiler en bas
    messageBox.scrollTop = messageBox.scrollHeight;
    });

</script>


