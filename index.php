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

    Name: <input type="text" name="name" value="<?php echo $name; ?>"><br><br>
    Datum: <input type="date" name="date" value="<?php echo $date; ?>"><br><br>
    Beschreibung: <textarea type="text" name="description" rows="5" cols="50"
                            value="<?php echo $description; ?>"></textarea><br><br>
    Maximale Anzahl Personen: <input type="number" name="max" value="<?php echo $max; ?>"><br><br>
    Submit: <input type="submit" value="submit"><br>

</form>

<?php

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/events.json';
if (file_exists($filename)) {
    $message = "Event Page Exists";
} else $events = fopen($filename, 'w');

if (isset($_POST["name"])) {
    if ($_POST["name"] > 0) {
        $newEvent = array(
            "name" => $_POST['name'],
            "date" => $_POST['date'],
            "description" => $_POST['description'],
            "max" => $_POST['max']
        );

    }

    $test = file_get_contents("events.json");
    $oldEvent = json_decode($test, true);
    $oldEvent[] = $newEvent;
    $safeEvent = $oldEvent;


    $encoded_data = json_encode($safeEvent, JSON_PRETTY_PRINT, 512);
    file_put_contents("events.json", $encoded_data);

    $decodedData = json_decode($encoded_data, null, 512, 0);

    foreach ($decodedData as $event) {
        foreach ($event as $daten) {
            echo $daten . "<br />";
        }
    }

//    print("<pre>" . print_r($decodedData, true) . "</pre>");
}
?>


</body>
</html>

