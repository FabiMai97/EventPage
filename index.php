<?php declare(strict_types=1);

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

$homeController = new \Controller\HomeController();
$homeController->controller();

$loginController = new \Controller\LoginController();
$loginController->login();

$registrationController = new \Controller\RegistrationController();
$registrationController->register();

$logoutController = new \Controller\LogoutController();
$logoutController->logout();
