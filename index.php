<?php declare(strict_types=1);

use Controller\HomeController;
use Controller\LoginController;
use Controller\LogoutController;
use Controller\RegistrationController;

require_once __DIR__ . '/vendor/autoload.php';

$latte = new Latte\Engine;
$latte->setTempDirectory(__DIR__ . '/temp');
$latte->setautoRefresh();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require_once '/home/fabianmaiwald/PhpstormProjects/EventPage/Controller/HomeController.php';
require_once '/home/fabianmaiwald/PhpstormProjects/EventPage/Controller/LoginController.php';
require_once '/home/fabianmaiwald/PhpstormProjects/EventPage/Controller/RegistrationController.php';
require_once '/home/fabianmaiwald/PhpstormProjects/EventPage/Controller/LogoutController.php';

if ($_SERVER['REQUEST_URI'] === '/index.php?page=login') {
    $loginController = new LoginController();
    $loginController->login();
} elseif ($_SERVER['REQUEST_URI'] === '/index.php?page=registrierung') {
    $registrationController = new RegistrationController();
    $registrationController->register();
} elseif ($_SERVER['REQUEST_URI'] === '/index.php?page=logout') {
    $logoutController = new LogoutController();
    $logoutController->logout();
} else {
    $homeController = new HomeController();
    $homeController->controller();
}

