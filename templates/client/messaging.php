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



<?php
include("../../includes/config.php");  // Assurez-vous que cette inclusion est nécessaire

session_start();

// Assurez-vous que vous avez une session utilisateur active
if (!isset($_SESSION['user_id'])) {
    header("Location: loginold.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$_SESSION['user_id'] = $row['id_users'];
$_SESSION['id_enterprise'] = $row['id_enterprise']; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérez l'id de l'entreprise de l'utilisateur actuel
$sql = "SELECT id_enterprise FROM users WHERE id_users = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$currentUser = $result->fetch_assoc();

if (!$currentUser) {
    die("User not found");
}

$enterprise_id = $currentUser['id_enterprise'];

// Récupérez toutes les personnes ayant la même id_enterprise que l'utilisateur actuel, en excluant l'utilisateur actuel
$sql = "SELECT * FROM users WHERE id_enterprise = ? AND id_users != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $enterprise_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$otherPeople = [];

while ($row = $result->fetch_assoc()) {
    $otherPeople[] = $row;
}

?>


<?php
include("../../includes/config.php");

session_start();

// Vérifiez si une session utilisateur est active
if (!isset($_SESSION['user_id'])) {
    header("Location: loginold.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Assurez-vous que la connexion à la base de données est établie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérez l'id de l'entreprise de l'utilisateur actuel
$sql = "SELECT id_enterprise FROM users WHERE id_users = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$currentUser = $result->fetch_assoc();

if (!$currentUser) {
    die("User not found");
}

$enterprise_id = $currentUser['id_enterprise'];

// Sélectionnez les informations de tous les capteurs de l'entreprise
$sql = "SELECT * FROM sensors WHERE id_enterprise = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $enterprise_id);
$stmt->execute();
$result = $stmt->get_result();


// N'oubliez pas de fermer la connexion à la base de données à la fin du script si nécessaire
$stmt->close();
$conn->close();
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
    <link rel="stylesheet" href="css/messaging.css">

    <title><?php echo $translations['dashboard_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Messaging</h1>
        <ul id="menu">
            <li><a href="#" class="active" onclick="changeSection(event,'messaging')">Messaging</a></li>

            <li><a class="active" href="#" onclick="changeSection(event,'overview')"></a></li>
        </ul>

        <section id="messaging" class="messaging_containers">
            <div class="messaging_sub_containers">
            <div class="container">
                <div class="users-list">
                    <ul>
                    <?php
                    include("../../includes/config.php");

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    session_start();

                    $currentUserId = $_SESSION['user_id'];
                    $currentEnterprise = $_SESSION['id_enterprise'];

                    $sql = "SELECT * FROM users WHERE id_enterprise = '$currentEnterprise'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li><a href="?user=' . urlencode($row['id_users']) . '">' . $row['FirstName'] . ' ' . $row['LastName'] . '</a></li><br>';
                            }
                        } else {
                            echo '<li>User not found.</li>';
                        }
                    } else {
                        echo "Erreur lors de la récupération des utilisateurs: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                    ?>

                    </ul>
                </div>
                <div class="chat_box">
                <?php
                // Fonction pour récupérer les informations de l'utilisateur
                function getUserInfo($conn, $userId) {
                    $sql = "SELECT FirstName, LastName FROM users WHERE id_users = $userId";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $userInfo = mysqli_fetch_assoc($result);
                        return $userInfo;
                    } else {
                        return array('FirstName' => 'Utilisateur', 'LastName' => 'Inconnu');
                    }
                }

                // Inclure le fichier de configuration
                include("../../includes/config.php");

                // Vérifier la connexion à la base de données
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Afficher la conversation avec l'utilisateur sélectionné
                if (isset($_GET['user'])) {
                    $selectedUserId = htmlspecialchars($_GET['user']);

                    // Afficher le nom de l'utilisateur sélectionné
                    $sqlUser = "SELECT FirstName, LastName FROM users WHERE id_users = $selectedUserId";
                    $resultUser = mysqli_query($conn, $sqlUser);

                    if ($resultUser && mysqli_num_rows($resultUser) > 0) {
                        $selectedUser = mysqli_fetch_assoc($resultUser);
                        echo '<h2 style="margin-bottom:10px;">' . $selectedUser['FirstName'] . ' ' . $selectedUser['LastName'] . '</h2>';

                        // Afficher les messages pour l'utilisateur sélectionné
                        $sqlMessages = "SELECT sender_id, message_content FROM messages WHERE (sender_id = $selectedUserId OR receiver_id = $selectedUserId)";
                        $resultMessages = mysqli_query($conn, $sqlMessages);
                        echo '<div class="message_box">';

                        if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
                            while ($rowMessages = mysqli_fetch_assoc($resultMessages)) {
                                $senderInfo = getUserInfo($conn, $rowMessages['sender_id']);
                                $messageClass = ($rowMessages['sender_id'] == $selectedUserId) ? 'sent' : 'received';
                            
                                echo '<div class="message ' . $messageClass . '">';
                                echo '<p><strong>' . $senderInfo['FirstName'] . ' ' . $senderInfo['LastName'] . ':</strong> ' . $rowMessages['message_content'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No messages found.</p>';
                        }
                        echo '</div>';

                        // Formulaire pour envoyer un message
                        echo '<form method="post" action="actions/send_message.php">';
                        echo '<input type="hidden" name="receiver_id" value="' . $selectedUserId . '">';
                        echo '<div class=" textarea_box">';
                        echo '<input type="text" name="message" id="message" rows="4" cols="50">';
                        echo '<button class="send" type="submit"><i class="fa-solid fa-paper-plane fa-lg"></i></button>';
                        echo '</div>';
                        echo '</form>';
                    } else {
                        echo '<p>User not found.</p>';
                    }
                } else {
                    echo '<p>Select a user to start the conversation.</p>';
                }
                // Fermer la connexion à la base de données
                mysqli_close($conn);
                ?>

                </div>
        </div>

            </div>
        </section>

        
        <section id="overview" class="overview_containers">
        </section>

    </main>




</body>
</html>


<script>
        function changeSection(event, sectionId) {
            event.preventDefault();
            document.getElementById('messaging').style.display = 'none';

            document.getElementById('overview').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }


    document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez l'élément avec la classe "message_box"
    var messageBox = document.querySelector(".message_box");

    // Réglez la propriété scrollTop sur la hauteur totale de l'élément pour le faire défiler en bas
    messageBox.scrollTop = messageBox.scrollHeight;
    });

    </script>













