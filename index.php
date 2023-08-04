<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php

$name = $date = $description = $max = "";
?>

<form action="" method="post">

Name: <input type="text" name="name" value="<?php echo $name;?>"><br><br>
Datum: <input type="date" name="date" value="<?php echo $date;?>"><br><br>
Beschreibung: <textarea type="text" name="description" rows="5" cols="50" value="<?php echo $description;?>"></textarea><br><br>
Maximale Anzahl Personen: <input type="number" name="max" value="<?php echo $max;?>"><br><br>
Submit: <input type="submit" value="submit"><br>

</form>

<?php

if(isset($_POST['submit'])){

    $newEvent = array(
            "name" => $_POST['name'],
            "date" => $_POST['date'],
            "description" => $_POST['description'],
            "max" => $_POST['max']
    );

if(filesize("events.json")==0){
    $firstEvent = array($newEvent);
    $safeEvent = $firstEvent;
}else{
    $oldEvent = json_decode(file_get_contents("events.json"));
    array_push($oldEvent, $newEvent);
    $safeEvent = $oldEvent;
}

$encoded_data = json_encode($safeEvent, JSON_PRETTY_PRINT);

if(!file_put_contents("events.json", $encoded_data, LOCK_EX)){
        $error = "Error storing Event, please try again";
    }else{
        $success = "Event is stored";
    }
}
?>




<?php
//
//echo "<br><br>";
//echo htmlspecialchars($_POST["name"]);
//echo "<br><br>";
//echo "Datum: " . htmlspecialchars($_POST["date"]);
//echo "<br><br>";
//echo "Beschreibung: " . htmlspecialchars($_POST["description"]);
//echo "<br><br>";
//echo "Maximale Anzahl von Personen: " . htmlspecialchars($_POST["max"]);
//
//?>


</body>
</html>



