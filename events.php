<?php
// Obtenez la langue à partir des paramètres d'URL, des cookies, etc.
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Chargez le fichier de langue correspondant
$translations = include "lang/$lang.php";

// Si le formulaire est soumis, mettez à jour la langue
if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $translations = include "lang/$lang.php";
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
    <link rel="stylesheet" href="includes/footer/footer.css">
    <link rel="stylesheet" href="templates/css/events.css">
    <title><?php echo $translations['events_page']['page_title']; ?></title>

</head>
 <!---->
<body>
<div class="lang_container">
    <form method="post">
        <button type="submit" name="lang" value="en">
            <img src="https://emojigraph.org/media/twitter/flag-united-kingdom_1f1ec-1f1e7.png" width="30px" height="auto" alt="English Flag">
        </button>
        <button type="submit" name="lang" value="fr">
            <img src="https://emojigraph.org/media/twitter/flag-france_1f1eb-1f1f7.png" width="30px" height="auto" alt="French Flag">
        </button>
    </form>

</div>
<?php include("includes/navigations/navigations.php"); ?>

<main>
    <section class="search_containers">
        <h1>Events</h1>
        <form action="/action_page.php" method="post">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </section>
    <section class="events_grid_containers">

        <div class="card">
            <div class="header_container">
                <div>
                    <h3>Title</h3>
                    <p>22/12/2023 at 4PM</p>
                </div>
                <a href=""><i class="fa-solid fa-ellipsis-vertical"></i></a>
            </div>
            <img src="https://www.confort-moderne.fr/assets/events_back_in_pictures/62542d24d82df_basse-def-giantswan-45.jpg" alt="">
            <div>
                <h3>Description :</h3><br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis perspiciatis at beatae, quasi dolorem eveniet...</p>
            </div>
            <div class="action_container">
                <div style="display: flex; width:50px; gap: 10px;">
                    <a href=""><i class="fa-solid fa-check-to-slot fa-lg"></i></a>
                    <p>11</p>
                </div>
                <p>by SoundPlus</p>

            </div>

            <div class="tag_container">
                <a href="">test </a>
                <a href="">test </a>
                <a href="">test </a>
                <a href="">test </a>
            </div>
            <div class="vote_container">
                <a href="">Vote</a>
            </div>
        </div>

        <div class="card">
            <div class="live_container">
                <div class="point"></div>
            </div>
            <div class="header_container">
                <div>
                    <h3>Title</h3>
                    <p>22/12/2023 at 4PM</p>
                    <br>
                </div>
                <a href=""><i class="fa-solid fa-ellipsis-vertical"></i></a>
            </div>
            <img src="https://www.confort-moderne.fr/assets/events_back_in_pictures/62542cc3dbe53_BAssdef-giantswan-31.jpg" alt="">
            <div>
                <h3>Description :</h3><br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis perspiciatis at beatae, quasi dolorem eveniet...</p>
            </div>
            <div class="action_container">
                <div style="display: flex; width:50px; gap: 10px;">
                    <a href=""><i class="fa-solid fa-check-to-slot fa-lg"></i></a>
                    <p>11</p>
                </div>
                <p>by SoundPlus</p>

            </div>

            <div class="tag_container">
                <a href="">test </a>
                <a href="">test </a>
                <a href="">test </a>
                <a href="">test </a>
            </div>
            <div class="vote_container">
                <a href="">Vote</a>
            </div>
        </div>

    </section>
</main>


<?php include("includes/footer/footer.php"); ?>


</body>
</html>



