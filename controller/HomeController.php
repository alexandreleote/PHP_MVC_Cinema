<?php

namespace Controller;
use Model\Connect;
use Model\HomeManager;

class HomeController {

    public function index() {
        $homeManager = new HomeManager();
        $film = $homeManager->getFeaturedFilm();

        require "view/home.php";
    }
}
