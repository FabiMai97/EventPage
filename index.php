<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include 'form.html';

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/events.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

if (isset($_POST['submit'])) {
    $newEvent = array(
        "id" => $_POST['id'] = uniqid('F', false),
        "name" => $_POST['name'],
        "date" => $_POST['date'],
        "description" => $_POST['description'],
        "max" => $_POST['max'],
        "isMax" => $_POST['isMax'] = 0
    );
    $error = [];

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
        $file = file_get_contents("events.json");
        $oldEvent = json_decode($file, true, 521);
        $oldEvent[] = $newEvent;
        $encodedData = json_encode($oldEvent, JSON_PRETTY_PRINT);
        file_put_contents("events.json", $encodedData);
    }
}

$old = json_decode(file_get_contents("events.json"), true);

echo '<h2> Festival Liste: </h2>';

foreach ($old as $dol) {

    echo "Name: " . $dol['name'] . "<br>";
    echo "Datum: " . $lod = date("d.m.y", strtotime($dol['date'])) . "<br>";
    echo "Beschreibung: " . $dol['description'] . "<br>";
    echo "Maximale Anzahl Personen: " . $dol['max'] . "<br>" . "<br>";
}

echo "<br>";

echo '<h2> Anmeldung:<br> </h2>';


foreach ($old as $registration) {
    echo $registration['name'] . ":" . "<br>";

    if ($registration['isMax'] < $registration['max'] - 1) {
        echo '<form action="" method="POST" >
                <input type="submit" name="binDabei_' . $registration['id'] . '" value="Bin Dabei!"><br></form>';
    }

    $bName = 'binDabei' . '_' . $registration['id'];


    if (isset($_POST[$bName])) {
        $addition = json_decode(file_get_contents("events.json"), true);
        $targetId = $registration['id'];
        $newValue = ++$registration['isMax'];

        foreach ($addition as $key => $participant) {
            if ($participant['id'] === $targetId) {
                $addition[$key]['isMax'] = $newValue;

            }

        }

        file_put_contents("events.json", json_encode($addition, JSON_PRETTY_PRINT));
    }

    echo "Der Zeit angemeldet: " . $registration['isMax'] . " / " . $registration['max'] . "<br>" . "<br>";
}


