<?php

session_start();

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/../../includes/config2.php";

$declaration = $mysqli->prepare("SELECT * FROM users WHERE reset_token_hash = ?");
$declaration->bind_param("s", $token_hash);
if ($declaration->execute()) {
    $result = $declaration->get_result();
    $user = $result->fetch_assoc();
}

if ($user === null) {
    header("Location: forgot-password.php?token_non_trouve=1");
    exit;
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    header("Location: forgot-password.php?token_expire=1");
    exit;
}

if (strlen($_POST["password"]) < 8) {
    header("Location: forgot-password.php?erreur_mdp=1");
    exit;
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    header("Location: forgot-password.php?erreur_mdp=1");
    exit;
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    header("Location: forgot-password.php?erreur_mdp=1");
    exit;
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    header("Location: forgot-password.php?erreur_mdpconf=1");
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET Password= ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id_users = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $password_hash, $user["id_users"]);
$stmt->execute();

echo "Password updated. You can now login.";

header('Location: http://soundplus.matteoschwarz.com/templates/accounts/login.php');
exit;
