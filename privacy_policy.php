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
    <link rel="stylesheet" href="templates/css/term.css">
    <title><?php echo $translations['index_page']['page_title']; ?></title>

</head>
 <!---->
<body>
  <div class="lang_container">
    <a class="back" href="index.php"><i class="fa-solid fa-chevron-left fa-lg"></i></a>

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
  <main>
    <br><br>
    <h1>Website Terms and Conditions of Use</h1><br><br>

    <h2>1. Terms</h2><br>

    <p>By accessing this Website, accessible from sound-plus.fr, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.</p>
    <br>
    <h2>2. Use License</h2><br>

    <p>Permission is granted to temporarily download one copy of the materials on Sound Plus's Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
    <br>
    <ul>
        <li>modify or copy the materials;</li>
        <li>use the materials for any commercial purpose or for any public display;</li>
        <li>attempt to reverse engineer any software contained on Sound Plus's Website;</li>
        <li>remove any copyright or other proprietary notations from the materials; or</li>
        <li>transferring the materials to another person or "mirror" the materials on any other server.</li>
    </ul>
    <br>
    <p>This will let Sound Plus to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format.</p>
      <br>
    <h2>3. Disclaimer</h2><br>

    <p>All the materials on Sound Plus's Website are provided "as is". Sound Plus makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, Sound Plus does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.</p>
    <br>
    <h2>4. Limitations</h2><br>
    <br>
    <p>Sound Plus or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on Sound Plus's Website, even if Sound Plus or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.</p>
    <br>
    <h2>5. Revisions and Errata</h2><br>
    <br>
    <p>The materials appearing on Sound Plus's Website may include technical, typographical, or photographic errors. Sound Plus will not promise that any of the materials in this Website are accurate, complete, or current. Sound Plus may change the materials contained on its Website at any time without notice. Sound Plus does not make any commitment to update the materials.</p>
    <br>
    <h2>6. Links</h2><br>
    <br>
    <p>Sound Plus has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by Sound Plus of the site. The use of any linked website is at the user's own risk.</p>
    <br>
    <h2>7. Site Terms of Use Modifications</h2><br>
    <br>
    <p>Sound Plus may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.</p>
    <br>
    <h2>8. Your Privacy</h2><br>
    <br>
    <p>Please read our Privacy Policy.</p><br>
    <br>
    <h2>9. Governing Law</h2><br>
    <br>
    <p>Any claim related to Sound Plus's Website shall be governed by the laws of fr without regards to its conflict of law provisions.</p>
  </main>


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






