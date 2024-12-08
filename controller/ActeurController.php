<?php

namespace Controller;
use Model\ActeurManager;

class ActeurController {

    /* Lister les acteurs */
    public function listActeurs() {

        $acteurManager = new ActeurManager();
        $acteurs = $acteurManager->getActeurs();
        
        require "view/acteur/listActeurs.php";
    }

    /* Récupérer les details de l'acteur */
    public function detActeur($id) {
        
        $acteurManager = new ActeurManager();
        $details = $acteurManager->getDetActeur($id);
        $filmographie = $acteurManager->getFilmographie($id);

        require "view/acteur/detailActeur.php";
    }

    /* Modifier un acteur */
    public function modifyActeur($id) {

        $acteurManager = new ActeurManager();
        $details = $acteurManager->getDetActeur($id);
        $filmographie = $acteurManager->getFilmographie($id);

        require "view/acteur/editActeur.php";
    }

    /* Mettre à jour un acteur */
    public function updateActeur($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acteurManager = new ActeurManager();
            
            // Récupération et nettoyage des données
            $data = [
                'nom' => filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS),
                'prenom' => filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS),
                'genre' => filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS),
                'dateNaissance' => filter_input(INPUT_POST, 'dateNaissance'),
                'dateMort' => filter_input(INPUT_POST, 'dateMort'),
                'photo' => filter_input(INPUT_POST, 'photo', FILTER_SANITIZE_URL),
                'bg' => filter_input(INPUT_POST, 'bg', FILTER_SANITIZE_SPECIAL_CHARS),
                'bio' => filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_SPECIAL_CHARS),
                'estVivant' => filter_input(INPUT_POST, 'estVivant', FILTER_VALIDATE_BOOLEAN),
                'metiers' => isset($_POST['metiers']) ? $_POST['metiers'] : []
            ];

            $acteurManager->updateActeur($id, $data);
            
            // Redirection vers la page de détails de l'acteur
            header("Location: index.php?action=detailActeur&id=" . $id);
            exit();
        }
    }

    /* Supprimer un acteur */
    public function deleteActeur($id) {
        $acteurManager = new ActeurManager();
        if($acteurManager->delActeur($id)) {
            header("Location: index.php?action=listActeurs");
            exit();
        }
    }
}
