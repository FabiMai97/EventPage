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

require_once __DIR__ . '/../EventPage/Controller/HomeController.php';
require_once __DIR__ . '/../EventPage/Controller/LoginController.php';
require_once __DIR__ . '/../EventPage/Controller/RegistrationController.php';
require_once __DIR__ . '/../EventPage/Controller/LogoutController.php';
require_once __DIR__ . '/../EventPage/Model/UserRepository.php';


switch ($_SERVER['REQUEST_URI']) {
    case '/index.php?page=login':
        $loginController = new LoginController();
        $loginController->login();
        break;
    case '/index.php?page=registrierung':
        $registrationController = new RegistrationController();
        $registrationController->register();
        break;
    case '/index.php?page=logout':
        $logoutController = new LogoutController();
        $logoutController->logout();
        break;
    default :
        $homeController = new HomeController();
        $homeController->controller();
}