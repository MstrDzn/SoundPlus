<?php
include("includes/getUsersInfo.php");
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

?>


<?php
include("../../includes/config.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: loginold.php");
    exit();
}


$user_id = $_SESSION['user_id'];


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

if ($result->num_rows > 0) {
    // Si des capteurs sont trouvés, affichez les informations
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $live_values = $row['live_values'];
    }
}
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
    <link rel="stylesheet" href="css/dashboard.css">

    <title><?php echo $translations['dashboard_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Dashboard</h1>
        <ul id="menu">
            <li><a class="active" href="#" onclick="changeSection(event,'overview')">Overview</a></li>
            <li style="display:none;"><a href="#" onclick="changeSection(event,'tasks')">Tasks</a></li> <!--ENLEVER LE STYLE-->
            <li style="display:none;"><a href="#" onclick="changeSection(event,'documents')">Documents</a></li>
            <?php
            if ($role === 'Owner' or $role === 'Technician' ) :
            ?>
            <li><a href="#" onclick="changeSection(event,'team')">Team</a></li>
            <?php
            endif;
            ?>
        </ul>

        <section id="overview" class="overview_containers">

            <?php
            include("../../includes/config.php");

            session_start();

            ?>

            <div class="choose_containers" >
            <select name="placeSelect" id="placeSelect">
                <?php foreach ($locations as $location): ?>
                    <option value="<?php echo $location['id_place']; ?>"><?php echo $location['name']; ?></option>
                <?php endforeach; ?>
            </select>

            <select name="roomSelect" id="roomSelect">
                <?php foreach ($rooms as $room): ?>
                    <option value="<?php echo $room['id_room']; ?>"><?php echo $room['name']; ?></option>
                <?php endforeach; ?>
            </select>

            <select name="sensorSelect" id="sensorSelect">
                <?php foreach ($sensors as $sensor): ?>
                    <option value="<?php echo $sensor['id_sensor']; ?>"><?php echo $sensor['name']; ?></option>
                <?php endforeach; ?>
            </select>

            <button><i class="fa-solid fa-arrows-rotate fa-lg"></i></button>
            </div>


            <br>
            <div class="stats_containers">
                <div class="stats_card">
                    <h4>Sensors Values</h4>
                    <div class="badge_containers">
                        <p class="title">
                        <?php
                        // Assurez-vous que $live_values est défini
                            $live_values = isset($live_values) ? $live_values : 0;

                            // Affichez la valeur
                            echo "$live_values dB";
                        ?>
                        </p>
                        <div class="badge_live"><p>LIVES</p></div>
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

                <h1>Hello, <?php echo "Lastname: $lastname<br>"; ?> </h1>
            </div>

        </section>

        <section id="documents" class="documents_containers">
            so
        </section>

        <section id="team" class="team_containers">
            <div class="teams_sub_containers">
            <?php
                // Affiche le tableau HTML si $otherPeople contient des données
                if (!empty($otherPeople)) {
                    echo '<table border="1">';
                    echo '<thead><tr><th>Customer Name</th><th>Email</th><th>Role</th><th>Actions</th> </tr></thead>';
                    echo '<tbody>';

                    foreach ($otherPeople as $person) {
                        echo '<tr>';
                        echo '<td>' . $person['FirstName'] . "\n" . $person['LastName'] . '</td>';
                        echo '<td>' . $person['Mail'] . '</td>';
                        echo '<td>' . $person['Role'] . '</td>';
                        echo '<td>' . '<a style="display: inline-block; color: #FF371F;" href=""><i class="fa-solid fa-trash fa-lg"></i></a>' . '</td>';

                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo '<p>No people found in the same company.</p>';
                }
                ?>
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