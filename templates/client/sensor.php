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
        echo "User not found.";
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
    // L'utilisateur actuel n'a pas été trouvé, gestion d'erreur si nécessaire
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

// Maintenant, $otherPeople contient toutes les personnes de la même entreprise que l'utilisateur actuel, à l'exception de l'utilisateur actuel lui-même.
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
    <link rel="stylesheet" href="css/sensor.css">

    <title><?php echo $translations['dashboard_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Sensors</h1>
        <ul id="menu">
            <li><a href="#" class="active" onclick="changeSection(event,'sensors')">Sensors</a></li>
            <li><a href="#" onclick="changeSection(event,'actions')">Actions</a></li>

            <li><a class="active" href="#" onclick="changeSection(event,'overview')"></a></li>
        </ul>

        <section id="sensors" class="sensors_containers">
            <div class="sensors_sub_containers">
                <div class="button_containers">
                    <button onclick="openPopup()" class="add"><i class="fa-solid fa-plus fa-lg"></i> Add Sensor</button><br>
                </div>
            <?php
            if ($result->num_rows > 0) {
                // Si des capteurs sont trouvés, affichez les informations dans un tableau HTML
                echo "<table>
                        <thead>
                            <th>Nom du capteur</th>
                            <th>Valeurs en direct</th>
                            <th>Status</th>
                            <th>Room</th>
                            <th>Actions</th>

                        </thead>";

                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $live_values = $row['live_values'];
                    $status = $row['status'];
                    $room = $row['room'];

                    // Ajoutez une nouvelle ligne au tableau pour chaque capteur
                    echo "<tr>
                        <td>$name</td>
                        <td>$live_values</td>
                        <td>$status</td>
                        <td>$room</td>
                        <td><a style='display: inline-block;' href=''><i class='fa-solid fa-power-off fa-lg'></i></a>\n<a style='display: inline-block; color: #FF371F;' href=''><i class='fa-solid fa-trash fa-lg'></i></a></td>
                    </tr>";
            
                }

                echo "</table>";
            } else {
                echo "No sensors found for this company.";
            }
            ?>
            </div>
        </section>
        
        <section id="actions" class="actions_containers" >

        </section>
        
        <section id="overview" class="overview_containers">
        </section>

    </main>





    <div id="popup">
        <form action="actions/add_sensors.php" method="post">
            <label for="name">Name :</label>
            <input type="text" required name="name" required><br>
            
            <label for="live_values">Values :</label>
            <input type="text" required name="live_values"><br>
            
            <label for="salle">Room :</label>
            <input type="text" required name="salle" required><br>
            
            <input type="submit" value="Add sensors">
        </form>
        <button onclick="closePopup()">Fermer</button>
    </div>

</body>
</html>


<script>
        function changeSection(event, sectionId) {
            event.preventDefault();
            document.getElementById('sensors').style.display = 'none';
            document.getElementById('actions').style.display = 'none';
            document.getElementById('overview').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>





<script src="js/pop_up.js"></script>












