<?php

require_once __DIR__ . '/vendor/autoload.php';

$latte = new Latte\Engine;
$latte->setTempDirectory(__DIR__ . '/temp');
$latte->setautoRefresh();


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/json/events.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

$error = [];
$newEvent = [];

if (isset($_POST['submit'])) {
    $newEvent = [
        "id" => $_POST['id'] = uniqid('F', false),
        "name" => $_POST['name'],
        "date" => $_POST['date'],
        "description" => $_POST['description'],
        "max" => $_POST['max'],
        "isMax" => $_POST['isMax'] = 0,
    ];

    if (strlen($_POST['name']) <= 3) {
        $error['name'] = "";
    }
    if (strtotime($_POST['date']) < time()) {
        $error['date'] = "";
    }
    if (strlen($_POST['description']) <= 5) {
        $error['description'] = "";
    }
    if (!is_numeric($_POST['max']) || $_POST['max'] < 0) {
        $error['max'] = "";
    }
    if (empty($error)) {
        $file = file_get_contents("json/events.json");
        $oldEvent = json_decode($file, true, 521);
        $oldEvent[] = $newEvent;
        $encodedData = json_encode($oldEvent, JSON_PRETTY_PRINT);
        file_put_contents("json/events.json", $encodedData);
    }
}

$old = json_decode(file_get_contents("json/events.json"), true);



foreach ($old as $registration) {

    $bName = 'binDabei' . '_' . $registration['id'];

    if (isset($_POST[$bName])) {
        $addition = json_decode(file_get_contents("json/events.json"), true);
        $targetId = $registration['id'];
        $newValue = ++$registration['isMax'];

        foreach ($addition as $key => $participant) {
            if ($participant['id'] === $targetId) {
                $addition[$key]['isMax'] = $newValue;

            }
        }
        file_put_contents("json/events.json", json_encode($addition, JSON_PRETTY_PRINT));
        header("Location: /index.php");
    }
}

$name =  $_POST['name'];
$date = $_POST['date'];
$description = $_POST['description'];
$max = $_POST['max'];

$latte->render(__DIR__ . '/templates/index.latte', [
    'old' => $old,
    'error' => $error,
    'newEvent' => $newEvent,
    'name' => $name,
    'date' => $date,
    'description' => $description,
    'max' => $max,
]);


