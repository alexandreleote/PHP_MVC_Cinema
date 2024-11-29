<?php

namespace Service;

abstract class Utils {

    public static function formatDate(string $date, string $pattern) {
        $dateObject = new \DateTime($date);
        $formatter = new \IntlDateFormatter(
            'fr_FR', 
            \IntlDateFormatter::LONG, 
            \IntlDateFormatter::NONE,
            'Europe/Paris',
            \IntlDateFormatter::GREGORIAN,
            $pattern
        );
        $formattedDate = $formatter->format($dateObject);
        return $formattedDate;
    }

    public static function getMetiers() {
        
    }
}