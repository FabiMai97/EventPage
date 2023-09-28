<?php

namespace Model;

class EventEntityManager
{

    public function saveAll(array $newEvent, array $allEvents): void
    {

        $allEvents[] = $newEvent;
        file_put_contents("json/events.json", json_encode($allEvents, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }
    public function add(array $addition): void
    {
        file_put_contents("json/events.json", json_encode($addition, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
    }

}

/* Repository zieht nur daten übergibt an controller zum ändern dann in EntityManager und speichern*/