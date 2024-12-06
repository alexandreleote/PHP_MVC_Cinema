<?php

ob_start();

?>

<div class="container">
    <div class="film-detail">
        <div class="film-info">
            <h1 class="film-title"><?= $details['titre_film'] ?></h1>
            
            <div class="film-meta">
                <span><?= $details["genre"] ?></span>
                <span>Durée : <?= $details["duree"] ?> </span>
            </div>

            <p class="film-synopsis"><?= $details["synopsis"]?></p>
        </div>

        <div class="film-side">
            <img src="<?= $details["affiche"] ?>" 
                alt="Affiche du film <?= $details["titre_film"]?>"  
                class="film-poster">

            <div class="film-crew">
                <h2>Réalisation</h2>
                <div class="crew-grid">
                    <?php foreach($realisateur as $real) { ?>
                        <div class="crew-item">
                            <img src="<?= $real['photo'] ?>" 
                                alt="Photo de <?= $real["realisateur"]?>"
                                class="crew-image">
                            <h3><?= $real['realisateur'] ?></h3>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="film-cast">
                <h2>Casting</h2>
                <div class="cast-grid">
                    <?php foreach($casting as $cast) { ?>
                        <div class="cast-item">
                            <img src="<?= $cast['photo'] ?>" 
                                alt="Photo de <?= $cast["acteur"]?>"
                                class="cast-image">
                            <h3><?= $cast['acteur'] ?></h3>
                            <p>Rôle : <?= $cast['nomRole'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$titre = $details["titre_film"];
$metaDescription = "Détails du film " . $details["titre_film"];
$contenu = ob_get_clean();
require "view/template.php";
?>