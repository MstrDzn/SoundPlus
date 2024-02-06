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
    <link rel="icon" type="image/png" href="static/images/favicon.png" />
    <link rel="stylesheet" href="includes/navigations/navigations.css">
    <link rel="stylesheet" href="includes/footer/footer.css">
    <link rel="stylesheet" href="templates/css/style.css">
    <title><?php echo $translations['index_page']['page_title']; ?></title>

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
        <!-- Ajoutez d'autres boutons pour d'autres langues au besoin -->
    </form>

</div>
<?php include("includes/navigations/navigations.php"); ?>

<main>
    <section class="calltoaction_container_section">
        <div>
            <h1><?php echo $translations['index_page']['title_test']; ?></h1>
            <br>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elidolor mattis sit phasellus mollis sit aliquam sit nullam neques.</p>
            <br>
            <br>    
            <a href="templates/accounts/signin.php">Get in touch <i class="fa-solid fa-arrow-right"></i></a>
            <a href="about.php">Learn More</a>
        </div>
        <img src="static/images/index_logo.jpg" alt="">
    </section>

    <section class="stats_container_section">
        <h1>Numbers that showcase our success</h1>

        <div class="grid_container">
            <div>
                <h1>200+</h1>
                <h3>Active projects</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit aliquam mauris sed ma</p>
            </div>
            <div>
                <h1>100+</h1>
                <h3>Active companies</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit aliquam mauris sed ma</p>
            </div>
            <div>
                <h1>20+</h1>
                <h3>Active partnerships</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit aliquam mauris sed ma</p>
            </div>
            <div>
                <h1>200+</h1>
                <h3>Websites build</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit aliquam mauris sed ma</p>
            </div>
        </div>
    </section>


    <section class="contact_container_section" id="contact">ç
        <div class="sub_container">
            <div>
                <h1>Let us know what <br> you think!</h1>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing eli mattis sit phasellus mollis sit aliquam sit nullam.</p>
                <br>
                <br>
                <div class="social_media">
                    <a href=""><i class="fa-brands fa-facebook-f fa-lg"></i></a>
                    <a href=""><i class="fa-brands fa-x-twitter fa-lg"></i></a>
                    <a href=""><i class="fa-brands fa-instagram fa-lg"></i></a>
                    <a href=""><i class="fa-brands fa-linkedin-in fa-lg"></i></a>
                    <a href=""><i class="fa-brands fa-youtube fa-lg"></i></a>

                </div>
            </div>

        <form action="includes/send_mail.php" method="post">
            <label for="nom">Name </label><br>
            <input type="text" id="nom" name="nom"  required><br>

            <label for="email">Email </label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="message">Message </label><br>
            <textarea id="message" name="message" required></textarea><br>

            <input type="submit" value="Send message">
        </form>
        </div>
    </section>


    <section class="faq_container_section" id="faq">
        <div class="title_container">
            <h1>Frequently Asked Questions</h1>
            <br>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing eli <br> mattis sit phasellus mollis sit aliquam sit nullam.</p>
        </div>
        <div class="accordion_container">
            <div>
                <button class="accordion">How does your sensor system work to improve sound?</button>
                <div class="panel">
                    <p>Our sensor system utilizes advanced signal processing technology to detect and analyze variations in the sound environment. By automatically adjusting audio parameters, it optimizes sound quality in real-time.</p>
                </div>
            </div>

            <div>
                <button class="accordion">What advantages does your solution offer compared to existing systems?</button>
                <div class="panel">
                    <p>Our solution provides continuous sound optimization, adapting to changes in the sound environment. It ensures a high-quality audio experience without requiring constant user intervention.</p>
                </div>
            </div>

            <div>
                <button class="accordion">How can I integrate your solution into my nightclub or concert venue?</button>
                <div class="panel">
                    <p>Integration of our solution is straightforward and tailored to each environment. Our technical team will guide you through the installation process to ensure successful implementation.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials_container_section">
        <div class="title_container">
            <h1>What our clients have to say</h1>
            <br>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing eli <br> mattis sit phasellus mollis sit aliquam sit nullam.</p>
        </div>
        <div class="grid_container">
            <div class="sub_info_container">
                <div class="circle_avatar"><img src="https://static.vecteezy.com/ti/vecteur-libre/p3/3346249-jeune-homme-avec-lunettes-avatar-personnage-icon-gratuit-vectoriel.jpg" alt=""></div>
                <br>
                <h2>"Revitalized my work approach"</h2>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur eget maecenas sapien fusce egestas risus purus suspendisse turpis.</p>
                <br>
                <h2>Alexandre Lambert</h2>
                <br>
                <h3>VP of Marketing at Instagram</h3>
            </div>

            <div class="sub_info_container">
                <div class="circle_avatar"><img src="https://us.123rf.com/450wm/yupiramos/yupiramos2001/yupiramos200100935/136709682-jeune-homme-avec-des-lunettes-de-conception-d-illustration-vectorielle-caract%C3%A8re-avatar.jpg" alt=""></div>
                <br>
                <h2>"Revitalized my work approach"</h2>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur eget maecenas sapien fusce egestas risus purus suspendisse turpis.</p>
                <br>
                <h2>Lucas Dubois</h2>
                <br>
                <h3>VP of Marketing at TikTok</h3>
            </div>

            <div class="sub_info_container">
                <div class="circle_avatar"><img src="https://static.vecteezy.com/ti/vecteur-libre/p3/7802554-femme-avatar-portrait-jeune-brune-poil-court-femme-en-jaune-cavalier-conception-universelle-pour-blogs-forums-articles-d-information-publicite-personnage-de-dessin-anime-illustrationle-plat-vectoriel.jpg" alt=""></div>
                <br>
                <h2>"Revitalized my work approach"</h2>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur eget maecenas sapien fusce egestas risus purus suspendisse turpis.</p>
                <br>
                <h2>Sophie Martin</h2>
                <br>
                <h3>VP of Marketing at Snapchat</h3>
            </div>
        </div>
    </section>

</main>




<?php /* include("includes/footer/footer.php");  */?>

</body>
</html>



<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>






