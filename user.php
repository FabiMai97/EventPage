<?php

require_once __DIR__ . '/vendor/autoload.php';

$latte = new Latte\Engine;
$latte->setTempDirectory(__DIR__ . '/temp');
$latte->setautoRefresh();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/json/users.json';

if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}
$error = [];
$newUser = [];
$liste = array_column(json_decode(file_get_contents("json/users.json"), true), 'email', 'userName');

if (isset($_POST['register'])) {
    foreach ($liste as $list) {
        if ($list === $_POST['email']) {
            header("location: http://localhost:8000/login.php", true, 0);
            exit;
        }
    }
    if (isset($_POST['register'])) {
        $newUser = [
            "userName" => $_POST['userName'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

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
            $oldUser = json_decode(file_get_contents("json/users.json"), true);
            $oldUser[] = $newUser;
            file_put_contents("json/users.json", json_encode($oldUser, JSON_PRETTY_PRINT));
        }
    }
}
$userName = $_POST['userName'];
$email = $_POST['email'];

$latte->render(__DIR__ . '/templates/user.latte', [
    'error' => $error,
    'userName' => $userName,
    'email' => $email,
]);



