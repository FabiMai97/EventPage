<?php

namespace Model;

class EventEntityManager
{
    private string $filename = __DIR__ . '/../json/events.json';

    public function saveAll(array $addition): void
    {
        file_put_contents($this->filename, json_encode($addition, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }


}