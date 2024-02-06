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
    <link rel="stylesheet" href="css/events.css">

    <title><?php echo $translations['dashboard_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Events</h1>
        <ul id="menu">
            <li><a class="active" href="#" onclick="changeSection(event,'overview')">Overview</a></li>
            <li><a href="#" onclick="changeSection(event,'tasks')">Tasks</a></li>
            <li><a href="#" onclick="changeSection(event,'documents')">Playlist</a></li>
            <li><a href="#" onclick="changeSection(event,'team')">Music</a></li>
        </ul>

        <section id="overview" class="overview_containers">

            <div class="stats_containers">
                <div class="stats_card">
                    <h4>Users Total</h4>
                    <div class="badge_containers">
                        <p class="title">11.8M</p>
                        <div class="badge"><p>+2.5 %</p></div>
                    </div>
                </div>
                <div class="stats_card">
                    <h4>Users Total</h4>
                    <div class="badge_containers">
                        <p class="title">11.8M</p>
                        <div class="badge"><p>+2.5 %</p></div>
                    </div>
                </div>
                <div class="stats_card">
                    <h4>Users Total</h4>
                    <div class="badge_containers">
                        <p class="title">11.8M</p>
                        <div class="badge"><p>+2.5 %</p></div>
                    </div>
                </div>
                <div class="stats_card">
                    <h4>Users Total</h4>
                    <div class="badge_containers">
                        <p class="title">11.8M</p>
                        <div class="badge"><p>+2.5 %</p></div>
                    </div>
                </div>
            </div>

            <div class="dashboard_containers">
                <div class="dashboard_card">

                </div>
                <div class="dashboard_card">

                </div>
                <div class="dashboard_card_long">

                </div>
                
            </div>

        </section>

        <section id="tasks" class="tasks_containers">
            <div class="teams_card_long_first">

            </div>

        </section>

        <section id="documents" class="documents_containers">
            so
        </section>

        <section id="team" class="music_containers">
            <div class="music_sub_containers">

                <div class="music_card_long">
                  
                </div>

            </div>
        </section>

    </main>


</body>
</html>


<script>
        function changeSection(event, sectionId) {
            event.preventDefault();
            document.getElementById('overview').style.display = 'none';
            document.getElementById('tasks').style.display = 'none';
            document.getElementById('documents').style.display = 'none';
            document.getElementById('team').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>