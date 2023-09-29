<?php declare(strict_types=1);

namespace Controller;

use Latte\Engine;

use Core\EventValidierung;
use Model\EventEntityManager;
use Model\EventRepository;

require_once __DIR__ . '/../Model/EventEntityManager.php';
require_once __DIR__ . '/../Model/EventRepository.php';
require_once __DIR__ . '/../Core/EventValidierung.php';

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
        $eventRepository = new EventRepository();
        $allEvents = $eventRepository->findAll();

        $error = [];
        $newEvent = [];

        if (isset($_POST['submit'])) {
            $newEvent = [
                "eventId" => $_POST['eventId'] = uniqid('F', false),
                "name" => $_POST['name'],
                "date" => $_POST['date'],
                "description" => $_POST['description'],
                "max" => $_POST['max'],
                "isMax" => $_POST['isMax'] = 0,
            ];

            $validierung = new EventValidierung();
            $error = $validierung->setEventError($newEvent);

            if (empty($error)) {
                $allEvents[] = $newEvent;
                $eventEntityManager = new EventEntityManager();
                $eventEntityManager->saveAll($allEvents);

                header("location: http://localhost:8000/index.php");
            }
        }

        foreach ($allEvents as $registration) {

            $bName = 'binDabei' . '_' . $registration['eventId'];

            if (isset($_POST[$bName])) {
                $addition = $allEvents;
                $targetId = $registration['eventId'];
                $newValue = ++$registration['isMax'];

                foreach ($addition as $key => $participant) {
                    if ($participant['eventId'] === $targetId) {
                        $addition[$key]['isMax'] = $newValue;
                    }
                }
                $eventEntityManager = new EventEntityManager();
                $eventEntityManager->saveAll($addition);
                header("Location: /index.php");
            }
        }

        $name = $_POST['name'] ?? NULL;
        $date = $_POST['date'] ?? NULL;
        $description = $_POST['description'] ?? NULL;
        $max = $_POST['max'] ?? NULL;
        $userName = $_SESSION["username"] ?? NULL;

        $this->latte->render(__DIR__ . '/../View/home.latte', [
            'allEvents' => $allEvents,
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