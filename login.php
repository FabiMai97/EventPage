<?php

require_once __DIR__ . '/vendor/autoload.php';

$latte = new Latte\Engine;
$latte->setTempDirectory(__DIR__ . '/temp');
$latte->setautoRefresh();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
$error = "";
$users = json_decode(file_get_contents("json/users.json"), true);

if (isset($_POST['loginSubmit'])) {
    foreach ($users as $user) {
        if ((password_verify($_POST['loginPassword'], $user['password'])) && ($_POST['loginMail']) === $user['email']) {
            $_SESSION["username"] = $user['userName'];
            header("location: http://localhost:8000/index.php", true, 0);
            exit;
        }else{
            $error = "Falsche E-Mail oder Passwort!";
        }
    }
}
$email = $_POST['loginMail'] ?? NULL;

$latte->render(__DIR__ . '/templates/login.latte', [
    'error' => $error,
    'email' => $email,
]);