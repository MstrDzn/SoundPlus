<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;

$recup_email = $_POST["recup_email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/../../includes/config2.php";

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE Mail = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $recup_email);
$stmt->execute();


$sql_prenom = "SELECT FirstName FROM users WHERE Mail = ?";
$sql_prenom = $mysqli->prepare($sql_prenom);
$sql_prenom->bind_param("s", $recup_email);
$sql_prenom->execute();
$sql_prenom->bind_result($prenom_recup);
$sql_prenom->fetch();
$sql_prenom->close();


//required files
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["recup_submit"])) {

    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'noreplysoundplus@gmail.com';   //SMTP write your email
    $mail->Password   = 'wklcgvesvhacqxey';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom("noreplysoundplus@gmail.com", "soundplus"); // Sender Email and name
    $mail->addAddress("$recup_email");     //Add a recipient email
    $mail->addReplyTo("noreply.imecoute@gmail.com", "soundplus"); // reply to sender email

    //Content
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->Subject = "Réinitialisation de votre mot de passe Soundplus";   // email subject headings


    $imagePath = 'images/logo_nobg.png'; // Chemin absolu ou relatif de votre image
    $imageData = base64_encode(file_get_contents($imagePath)); // Convertir l'image en base64
    $imageMimeType = mime_content_type($imagePath);
    $imageDataUri = 'data:' . $imageMimeType . ';base64,' . $imageData;

    $body = <<<END

    Bonjour $prenom_recup, 
    <br>
    <br>
    Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte. 
    <br>
    <br>
    Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer ce message.
    <br>
    <br>
    Pour réinitialiser votre mot de passe, veuillez cliquer sur <a href="http://soundplus.matteoschwarz.com/templates/accounts/reset-password.php?token=$token">ce lien</a>.
    <br>
    <br>
    Ce lien expirera dans 30 min. Assurez-vous de réinitialiser votre mot de passe dans ce délai.
    <br>
    <br>
    Merci,
    <br>
    L'équipe Soundplus
    END;

    $body .= '<p><img src="' . $imageDataUri . '" alt="Image" style="max-width: 10%; height: auto;"></p>';



    $mail->isHTML(true);
    $mail->Body = $body;

    // Success sent message alert
    $mail->send();
    header("Location: success_email.php?verif_email=1");
    exit;
}

