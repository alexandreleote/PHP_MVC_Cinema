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
        $details = $acteurManager->getDetActeur($id);
        $filmographie = $acteurManager->getFilmographie($id);

        require "view/acteur/detailActeur.php";
    }

    public function modifyActeur($id) {

        $acteurManager = new ActeurManager();
        $details = $acteurManager->getDetActeur($id);
        $filmographie = $acteurManager->getFilmographie($id);

        require "view/acteur/editActeur.php";
    }

    public function deleteActeur($id) {
        $acteurManager = new ActeurManager();
        if($acteurManager->delActeur($id)) {
            header("Location: index.php?action=listActeurs");
            exit();
        }
    }
}
