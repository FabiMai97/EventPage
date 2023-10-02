<?php declare(strict_types=1);

namespace App\Controller;

use Latte\Engine;

use App\Model\UserRepository;

class LoginController
{
    public Engine $latte;

    public function __construct()
    {
        $this->latte = new Engine();
        $this->latte->setTempDirectory(__DIR__ . '/temp');
        $this->latte->setautoRefresh();
    }
    public function login(): void
    {
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

        $this->latte->render(__DIR__ . '/../View/login.latte', [
            'error' => $error,
            'email' => $email,
        ]);
    }
}
