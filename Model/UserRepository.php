<?php

namespace Model;

class UserRepository
{
    public function findByUsername(string $userName): ?array
    {

        $filename = __DIR__ . '/../json/users.json';
        if (!file_exists($filename)) {
            file_put_contents($filename, json_encode([], JSON_THROW_ON_ERROR));
        }


        $allUser = json_decode(file_get_contents("json/users.json"), true, 512, JSON_THROW_ON_ERROR);

        foreach ($allUser as $targetUser) {
            if ($targetUser["email"] === $userName) {
                return $targetUser;
            }
        }
        return null;
    }

    /*public function findByMail($userMail): ?array
    {
        $allMail = json_decode(file_get_contents("json/users.json"), true, 512, JSON_THROW_ON_ERROR);

        foreach ($allMail as $targetMail) {
            if ($targetMail['email'] === $userMail) {
                return $targetMail;
            }
        }
        return null;
    }*/
}
