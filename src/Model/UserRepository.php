<?php

namespace App\Model;

class UserRepository
{
    private string $filename = __DIR__ . '/../json/users.json';

    public function __construct()
    {
        if (!file_exists($this->filename)) {
            file_put_contents($this->filename, json_encode([], JSON_THROW_ON_ERROR));
        }
    }

    public function findByEmail(string $userName): ?array
    {
        $allUser = json_decode(file_get_contents($this->filename), true, 512, JSON_THROW_ON_ERROR);

        foreach ($allUser as $targetUser) {
            if ($targetUser["email"] === $userName) {
                return $targetUser;
            }
        }
        return null;
    }

    public function findAllUser(): array
    {
        $allUser = json_decode(file_get_contents($this->filename), true, 512, JSON_THROW_ON_ERROR);
        return $allUser;
    }

}
