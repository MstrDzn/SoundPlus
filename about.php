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
    <link rel="stylesheet" href="templates/css/about.css">
    <title><?php echo $translations['about_page']['page_title']; ?></title>

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
    <section class="history containers">
        <h1>Our history</h1><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
    </section>
    <section class="objectives containers">
        <h1>Our objective</h1><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>

    </section>
    <section class="contact containers">
        <h1>Contact details</h1><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quisquam, facilis quas tempore nam itaque vitae exercitationem. Culpa nostrum, harum voluptatibus quod ipsa laudantium quo beatae. Sapiente minima magnam harum?</p>

    </section>
</main>


<?php include("includes/footer/footer.php"); ?>


</body>
</html>

<script src="templates/client/js/pop_up.js"></script>

