<?php

namespace Controller;
use Model\ActeurManager;

class ActeurController {

    /**
     * Lister les acteurs
     */
    public function listActeurs() {

        $acteurManager = new ActeurManager();
        $acteurs = $acteurManager->getActeurs();
        
        require "view/acteur/listActeurs.php";
    }

    public function detActeur($id) {
        
        $acteurManager = new ActeurManager();
        $details = $acteurManager->getDetActeurs($id);
        
        require "view/acteur/detailActeur.php";
    }
}
