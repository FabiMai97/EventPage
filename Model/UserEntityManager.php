<?php

namespace Model;

class UserEntityManager
{
    public function save(array $newUser): void
    {
        $userRepository = new UserRepository();
        $allUser = $userRepository->findAllUser();

        $allUser[] = $newUser;
        file_put_contents("json/users.json", json_encode($allUser, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }
}
//json decode raus aus dem EntityManager