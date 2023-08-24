<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'registrationForm.html';

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/users.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

if (isset($_POST['logIn'])) {
    $newUser = array(
        "userName" => $_POST['userName'],
        "email" => $_POST['email']

    );

    $oldUser = json_decode(file_get_contents("users.json"), true);
    $oldUser[] = $newUser;
    file_put_contents("users.json", json_encode($oldUser, JSON_PRETTY_PRINT));


}




