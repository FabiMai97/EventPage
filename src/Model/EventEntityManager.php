<?php

namespace App\Model;

class EventEntityManager
{
    private string $filename = __DIR__ . '/../json/events.json';

    public function saveAll(array $events): void
    {
        file_put_contents($this->filename, json_encode($events, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }
}