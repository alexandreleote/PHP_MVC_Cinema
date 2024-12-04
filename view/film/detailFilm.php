<?php

ob_start();

?>

<section>
    <article class="film-container">
        <div class="film-info">
            <div class="film-details">
                <h3> <?= $details['titre_film'] ?> </h3>
                <p>Note : </p>
                <p><?= $details["genre"] ?></p>
                <p>Durée : <?= $details["duree"] ?></p>
            </div>
            <figure class="picture-container">
                <img src="<?= $details["affiche"] ?>" 
                    alt="Affiche du film <?= $details["titre_film"]?>"  
                    class="film-picture">
            </figure>
        </div>
        <div class="film-bio">
            <p><?= $details["synopsis"]?></p>
        </div>
        <div class="modification">
            <button>
                <a href="index.php?action=editFilm&id=<?= $details["id_film"] ?>" class="btn">Mettre à jour la fiche</a>
            </button>
        </div>
    </article>
    <aside>
        <div id="realisation">
            <p>Réalisation :</p>
            <div class="info-display">
                <?php foreach($realisateur as $real) { ?>
                    <div class="display-card">  
                        <figure>
                            <img src="<?= $real['photo'] ?>" 
                            alt="Photo de <?= $real["realisateur"]?>"
                            class="profile-picture">
                        </figure>
                        <h4><?= $real['realisateur'] ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="casting">
            <p>Casting : </p>
            <div class="info-display">
                <?php foreach($casting as $cast) { ?>
                    <div class="display-card"> 
                        <figure>
                            <img src="<?= $cast['photo'] ?>" 
                            alt="Photo de <?= $cast['acteur'] ?>"
                            class="profile-picture">
                        </figure>
                        <h4><?= $cast['acteur'] ?></h4>
                        <p>Rôle : <?= $cast['nomRole']?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</section>


<?php

$metaDescription = 
    "On Air. - ".$details["titre_film"].
    " , réalisation : ".$real["realisateur"];

$titre = "détails du film";

$contenu = ob_get_clean();
require "view/template.php";