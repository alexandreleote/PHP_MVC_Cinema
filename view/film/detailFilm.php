<?php

ob_start();
$film = $requeteFilm->fetch()
?>

<p>Page de : <?= $film['titre_film'] ?></p>


<?php 

    $casting = $requeteCasting->fetchAll();
    foreach($casting as $cast) {
        echo $cast["acteur"]." dans le rôle de ".$cast["nomRole"]."<br>";
    }

?>

<?php

$titre = "détails du film";
$titre_secondaire = "Détails du film";
$contenu = ob_get_clean();
require "view/template.php";