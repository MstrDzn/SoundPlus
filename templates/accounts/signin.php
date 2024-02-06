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


// Vérifiez si l'utilisateur est déjà connecté avec le cookie
if (isset($_COOKIE['user_id'])) {
    // Redirigez vers le tableau de bord
    header("Location: ../client/dashboard.php");
    exit();
}

// Commencez la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="../../static/images/avatar.png" />
    <link rel="stylesheet" href="css/login.css">
    <title><?php echo $translations['signup_page']['page_title']; ?></title>
  </head>
  <body>
    <main>
        <section>
            <img src="images/logo_nobg.png" width="200px" height="200px" alt="">
            <h1>Protégez vos oreilles avec nos capteurs intelligents.</h1>
            <img src="" alt="">
        </section>

        <section class="animate__animated animate__fadeInRightBig animate__slow">

            <form action="back_end_post/process_signup.php" method="post">

                <div class="parent_form">
                    <div>
                        <i class="fa-regular fa-circle-user"></i>
                        <input type="text" id="lastname" name="lastname" placeholder="Last Name"><br>
                    </div>

                    <br>
                    
                    <div>
                        <i class="fa-regular fa-circle-user"></i>
                        <input type="text" id="firstname" name="firstname" placeholder="First Name"><br>
    
                    </div>

                    <br>

                    <div>
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" placeholder="Email Adress"><br>
    
                    </div>
                    
                    <br>
                    <div>
                        <i class="fa-solid fa-key"></i>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <br>
                    <a href="#" onclick="togglePassword()">Show password</a>
                

    
                    <input type="submit" value="Register">
                    <br>
                    <p>Already have an account ? <a href="login.php">Log in</a></p>

                </div>


            </form>
            <a class="home_buttons" href="../../index.php"><i class="fa-solid fa-house fa-lg"></i></a>
        </section>
    </main>
  </body>
</html>


<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var toggleLink = document.querySelector('a');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleLink.textContent = "Hide Password";
        } else {
            passwordField.type = "password";
            toggleLink.textContent = "Show Password";
        }
    }
</script>