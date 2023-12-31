<?php declare(strict_types=1);

namespace App\Controller;

use Latte\Engine;

use App\Model\UserEntityManager;
use App\Model\UserRepository;

class RegistrationController
{

    public Engine $latte;

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory(__DIR__ . '/temp');
        $this->latte->setautoRefresh();
    }

    public function register(): void
    {
        $error = [];
        $email = '';

        $userName = $_POST['email'] ?? '';
        $userRepository = new UserRepository();
        $existingUser = $userRepository->findByEmail($userName);


        if ($existingUser === null && isset($_POST['register'])) {
            $newUser = [
                "userId" => $_POST['userId'] = uniqid('F', false),
                "userName" => $_POST['userName'],
                "email" => $_POST['email'],
                "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];


            if (strlen($_POST['userName']) <= 3) {
                $error['userName'] = "";
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "";
            }
            if (strlen($_POST['password']) < 3) {
                $error['password'] = "";
            }

            if (empty($error)) {
                $userEntityManager = new UserEntityManager();
                $userEntityManager->save($newUser);
                $success = true;
            }
        }


        if (isset($_POST['register'])) {
            $userName = $_POST['userName'];
            $email = $_POST['email'];
        }
        $this->latte->render(__DIR__ . '/../View/registration.latte', [
            'error' => $error,
            'userName' => $userName,
            'email' => $email,
            'success' => $success ?? false,
        ]);
    }
}

