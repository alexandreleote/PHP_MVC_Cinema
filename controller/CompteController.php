<?php

namespace Controller;
use Model\CompteManager;

class CompteController {

    public function selectMovie() {

        $compteManager = new CompteManager();
        $films = $compteManager->selectMovie();

        require "view/compte/monCompte.php";
    }

    public function modifyMovie($id) {

        $compteManager = new CompteManager();
        $films = $compteManager->modifyMovie($id);

        require "view/compte/modifyContent.php";
    }
}