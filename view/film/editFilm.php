<?php

ob_start();

?>

<section>
    <article class="film-container modif-block">
        <div class="film-info modif-block">
            <div class="film-details modif-block">
                <h3> <?= $modifFilm['titre_film'] ?> </h3>
                <p>Note : </p>
                <p>Genres : </p>
                <?php foreach($genres as $genre) {?>
                    <input type="checkbox" id="<?= $genre['nom_genre']?>" name="<?= $genre['nom_genre']?>">
                    <label for="<?= $genre['nom_genre']?>"><?= $genre['nom_genre']?></label>
                <?php } ?>
                <p>Durée : <?= $modifFilm["duree"] ?></p>
            </div>
            <figure class="picture-container">
                <img src="<?= $modifFilm["affiche"] ?>" 
                    alt="Affiche du film <?= $modifFilm["titre_film"]?>"  
                    class="film-picture">
            </figure>
        </div>
        <div class="film-bio">
            <p><?= $modifFilm["synopsis"]?></p>
        </div>
        <div class="modification">
            <p>Form pour la bio</p>
        </div>
    </article>
    <aside class="modif-block">
        <div class="modif-block" id="realisation">
            <p>Réalisation :</p>
            <div class="info-display">
                <?php foreach($modifRealisateur as $modifReal) { ?>
                    <div class="display-card">  
                        <figure>
                            <img src="<?= $modifReal['photo'] ?>" 
                            alt="Photo de <?= $modifReal["realisateur"]?>"
                            class="profile-picture">
                        </figure>
                        <h4><?= $modifReal['realisateur'] ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="modif-block" id="casting">
            <p>Casting : </p>
            <div class="info-display">
                <?php foreach($modifCasting as $modifCast) { ?>
                    <div class="display-card"> 
                        <figure>
                            <img src="<?= $modifCast['photo'] ?>" 
                            alt="Photo de <?= $modifCast['acteur'] ?>"
                            class="profile-picture">
                        </figure>
                        <h4><?= $modifCast['acteur'] ?></h4>
                        <p>Rôle : <?= $modifCast['nomRole']?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</section>
<?php

$metaDescription = 
    "On Air. - modification : ".$modifFilm["titre_film"];

$titre = "modification ".$modifFilm["titre_film"];

$contenu = ob_get_clean();
require "view/template.php";