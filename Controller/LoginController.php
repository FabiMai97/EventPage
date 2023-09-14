<?php declare(strict_types=1);

namespace Controller;

use Latte\Engine;

class LoginController
{
    public Engine $latte;

    public function login(): void
    {
        $this->latte = new \Latte\Engine;
        $this->latte->setTempDirectory(__DIR__ . '/temp');
        $this->latte->setautoRefresh();

        $error = "";
        $users = json_decode(file_get_contents("json/users.json"), true);

        if (isset($_POST['loginSubmit'])) {
            foreach ($users as $user) {
                if ((password_verify($_POST['loginPassword'], $user['password'])) && ($_POST['loginMail']) === $user['email']) {
                    $_SESSION["username"] = $user['userName'];
                    header("location: http://localhost:8000/index.php", true, 0);
                    exit;
                }

                $error = "Falsche E-Mail oder Passwort!";
            }
        }

        $email = $_POST['loginMail'] ?? NULL;

        $this->latte->render('/home/fabianmaiwald/PhpstormProjects/EventPage/View/login.latte', [
            'error' => $error,
            'email' => $email,
        ]);

    }

}