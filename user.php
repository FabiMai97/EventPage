<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'registrationForm.html';

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/users.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

$user = json_decode(file_get_contents("users.json"), true);
$liste = array_column($user, 'email', 'userName');
if (isset($_POST['register'])) {
    foreach ($liste as $list) {
        if ($list === $_POST['email']) {
            header("location: http://localhost:8000/login.php", true, 0);
            exit;
        }
    }
    if (isset($_POST['register'])) {
        $newUser = array(
            "userName" => $_POST['userName'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );
        $error = [];
        $email = $_POST['email'];

        if (strlen($_POST['userName']) <= 3) {
            $error['userName'] = "";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "";
        }
        if (strlen($_POST['password']) < 3) {
            $error['password'] = "";
        }

        if (empty($error)) {
            $oldUser = json_decode(file_get_contents("users.json"), true);
            $oldUser[] = $newUser;
            file_put_contents("users.json", json_encode($oldUser, JSON_PRETTY_PRINT));
        } else {
            echo "<br>" . '<span style="color:#ff4500"> Mail is already used!';
        }

    }
}

