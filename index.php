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

?>
<form action="" method="post">

    <label> Name:
        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
        <?php if (isset($_POST['name']) && (strlen($_POST['name'])) <= 3) {
            echo '<span style="color:orangered"> Error: Der Eventname muss mehr als 3 Zeichen haben! </span>';
        } ?>
    </label><br><br>


    <label> Datum:
        <input type="date" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>">
        <?php if (isset($_POST['date']) && (strtotime($_POST['date'])) < time()) {
            echo '<span style="color:orangered"> Error: Das Datum muss in der Zukunft liegen! </span>';
        } ?>
    </label><br><br>


    <label>Beschreibung:
        <textarea type="text" name="description" rows="5"
                  cols="50"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
        <?php if (isset($_POST['description']) && (strlen($_POST['description'])) <= 5) {
            echo '<span style="color:orangered"> Error: Die Eventbeschreibung muss mehr als 5 Zeichen haben! </span>';
        } ?>
    </label><br><br>


    <label> Maximale Anzahl Personen:
        <input type="number" name="max" value="<?php echo isset($_POST['max']) ? $_POST['max'] : ''; ?>" min="1">
        <?php if (isset($_POST['max']) && (!is_numeric($_POST['max']) || $_POST['max'] < 0)) {
            echo '<span style="color:orangered"> Error: "Maximale Anzahl von Personen" darf nicht negativ sein! </span';
        } ?>
    </label><br><br>


    <label> Submit:
        <input type="submit" value="submit"><br><br>
    </label>
</form>

<?php

$filename = '/home/fabianmaiwald/PhpstormProjects/EventPage/events.json';
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode([]));
}

$oldData = file_get_contents("events.json");
$old = json_decode($oldData, true, 512, 0);

foreach ($old as $dol) {
    echo $dol['name'] . "<br>";
    echo $lod = date("d.m.y", strtotime($dol['date'])) . "<br>";
    echo $dol['description'] . "<br>";
    echo $dol['max'] . "<br>" . "<br>";
}

if (isset($_POST["name"])) {
    $newEvent = array(
        "name" => $_POST['name'],
        "date" => $_POST['date'],
        "description" => $_POST['description'],
        "max" => $_POST['max']
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
        $oldEvent = json_decode($file, true, 521, 0);
        $oldEvent [] = $newEvent;

        $encodedData = json_encode($oldEvent, JSON_PRETTY_PRINT);
        file_put_contents("events.json", $encodedData);

        echo $_POST['name'] . "<br>";
        echo date("d.m.y", strtotime($_POST['date'])) . "<br>";
        echo $_POST['description'] . "<br>";
        echo $_POST['max'] . "<br>" . "<br>";
    }
}
?>


</body>
</html>



