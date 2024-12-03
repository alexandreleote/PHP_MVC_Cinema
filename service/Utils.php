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

    public static function getAge(string $dateNaissance, mixed $dateAge) {
        $dateNaissance = new \DateTime($dateNaissance);
        if ($dateAge != null) {
            $dateAge = new \DateTime($dateAge);
        } else {
            $dateAge = new \DateTime('now');
        }
        $age = $dateNaissance->diff($dateAge)->y;
        return $age;
    }

    public static function getMetiers(array $details) {

        $statut = "";
        switch($details) {
            case ($details["id_realisateur"] != null && $details["id_acteur"] != null) : 
                $statut = ($details["genre"]) == "Homme" ? "Acteur / Réalisateur" : "Actrice / Réalisatrice";
                break;
            case ($details["id_acteur"] != null) :
                $statut = ($details["genre"]) == "Homme" ? "Acteur" : "Actrice";
                break;
            case ($details["id_realisateur"] != null) :
                $statut = ($details["genre"]) == "Homme" ? "Réalisateur" : "Réalisatrice";
                break;
        }
        return $statut;
    }

}