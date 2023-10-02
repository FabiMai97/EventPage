<?php declare(strict_types=1);

namespace Core;

class EventValidierung
{
    public function setEventError(array $newEvent): array
    {
        $error = [];
        if (strlen($newEvent['name']) <= 3) {
            $error['name'] = "name";
        }
        if (strtotime($newEvent['date']) < time()) {
            $error['date'] = "date";
        }
        if (strlen($newEvent['description']) <= 5) {
            $error['description'] = "description";
        }
        if (!is_numeric($newEvent['max']) || $newEvent['max'] < 0) {
            $error['max'] = "max";
        }
        return $error;
    }
}