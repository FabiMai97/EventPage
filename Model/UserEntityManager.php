<?php

namespace Model;

class UserEntityManager
{
    public function save(array $newUser): void
    {

        $oldUser = json_decode(file_get_contents("json/users.json"), true, 512, JSON_THROW_ON_ERROR);
        $oldUser[] = $newUser;//zurück in controller
        file_put_contents("json/users.json", json_encode($oldUser, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)); // zurück in controller
    }
}
//json decode raus aus dem EntityManager