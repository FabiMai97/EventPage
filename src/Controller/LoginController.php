<?php declare(strict_types=1);

namespace Controller;

use Latte\Engine;
use Model\UserRepository;

class LoginController
{
    public Engine $latte;

    public function login(): void
    {
        $this->latte = new Engine;
        $this->latte->setTempDirectory(__DIR__ . '/temp');
        $this->latte->setautoRefresh();

        $error = "";

        if (isset($_POST['loginSubmit'])) {

            $userName = $_POST['loginMail'];
            $userRepository = new UserRepository();
            $targetUser = $userRepository->findByEmail($userName);

            if (($targetUser !== null) && (password_verify($_POST['loginPassword'], $targetUser['password'])) && ($_POST['loginMail']) === $targetUser['email']) {
                $_SESSION["username"] = $targetUser['userName'];
                header('location: http://localhost:8000/index.php');
                exit;
            }
        }

        $email = $_POST['loginMail'] ?? NULL;

        $this->latte->render(__DIR__ . '/../src/View/login.latte', [
            'error' => $error,
            'email' => $email,
        ]);
    }
}
