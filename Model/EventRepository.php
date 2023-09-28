<?php

namespace Model;

class EventRepository
{
    public function findAll()
    {
        $filename = __DIR__ . '/../json/events.json';
        if (!file_exists($filename)) {
            file_put_contents($filename, json_encode([], JSON_THROW_ON_ERROR));
        }

        $allEvents = json_decode(file_get_contents("json/events.json"), true, 512, JSON_THROW_ON_ERROR);
        return $allEvents;
    }
}