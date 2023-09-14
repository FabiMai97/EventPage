<?php declare(strict_types=1);

namespace Controller;

use Latte\Engine;

class HomeController
{

    public Engine $latte;

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory(__DIR__ . '/temp');
        $this->latte->setautoRefresh();
    }

    public function controller(): void
    {

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

        $name = $_POST['name'] ?? NULL;
        $date = $_POST['date'] ?? NULL;
        $description = $_POST['description'] ?? NULL;
        $max = $_POST['max'] ?? NULL;
        $userName = $_SESSION["username"] ?? NULL;

        $this->latte->render('/home/fabianmaiwald/PhpstormProjects/EventPage/View/home.latte', [
            'old' => $old,
            'error' => $error,
            'newEvent' => $newEvent,
            'name' => $name,
            'date' => $date,
            'description' => $description,
            'max' => $max,
            'userName' => $userName,
        ]);
    }
}