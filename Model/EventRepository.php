<?php

namespace Model;

class EventRepository
{
    private string $filename = __DIR__ . '/../json/events.json';

    public function __construct()
    {
        if (!file_exists($this->filename)) {
            file_put_contents($this->filename, json_encode([], JSON_THROW_ON_ERROR));
        }
    }

    public function findAll(): array
    {
        $allEvents = json_decode(file_get_contents($this->filename), true, 512, JSON_THROW_ON_ERROR);
        return $allEvents;
    }
}