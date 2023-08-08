<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$name = $date = $description = $max = "";
?>

<form action="" method="post">

    Name: <input type="text" name="name" value=""><br><br>
    Datum: <input type="date" name="date" value=""><br><br>
    Beschreibung: <textarea type="text" name="description" rows="5" cols="50" value=""></textarea><br><br>
    Maximale Anzahl Personen: <input type="number" name="max" value=""><br><br>
    Submit: <input type="submit" value="submit"><br><br>

</form>

<?php

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/events.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

if (isset($_POST["name"])) {
    $newEvent = array(
        "name" => $_POST['name'],
        "date" => $_POST['date'],
        "description" => $_POST['description'],
        "max" => $_POST['max']
    );


    $test = file_get_contents("events.json");
    $oldEvent = json_decode($test, true);
    $oldEvent[] = $newEvent;
    $safeEvent = $oldEvent;


    $encoded_data = json_encode($safeEvent, JSON_PRETTY_PRINT, 512);
    file_put_contents("events.json", $encoded_data);

    $decodedData = json_decode($encoded_data, null, 512, 0);

    foreach ($decodedData as $event) {
        echo $event->name . "<br>";
        echo $event->date . "<br>";
        echo $event->description . "<br>";
        echo $event->max . "<br>" . "<br>";


    }
}
?>


</body>
</html>

