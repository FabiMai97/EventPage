<?php

namespace App\Model;

class UserEntityManager
{
    private string $filename = __DIR__ . '/../json/users.json';

    public function save(array $newUser): void
    {
        $userRepository = new UserRepository();
        $allUser = $userRepository->findAllUser();

        $allUser[] = $newUser;
        file_put_contents($this->filename, json_encode($allUser, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }
}
