<?php declare(strict_types=1);

namespace App\Controller;

class LogoutController
{
    public function logout(): void
    {
        if (isset($_POST['logout'])) {
            unset($_SESSION["username"]);
            header("location: /index.php");
        }
    }
}