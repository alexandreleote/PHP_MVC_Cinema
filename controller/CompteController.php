<?php

namespace Controller;
use Model\CompteManager;

class CompteController {

    public function selectMovie() {

        $compteManager = new CompteManager();
        $films = $compteManager->selectMovie();

        require "view/compte/monCompte.php";
    }

    
}