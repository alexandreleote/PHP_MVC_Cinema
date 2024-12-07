<?php

ob_start();

?>
<section>
    <article>
        <header>
            <h1>Modifier <span><?= $modifFilm["titre_film"] ?></span></h1>
        </header>

        <form action="index.php?action=updateFilm&id=<?= $modifFilm["id_film"] ?>" method="POST">
            <div role="group" aria-label="Informations principales">
                <!-- Affiche -->
                <figure>
                    <img src="<?= $modifFilm["affiche"] ?>" alt="Affiche de <?= $modifFilm["titre_film"] ?>">
                    <figcaption>
                        <label for="affiche">Affiche (URL) :</label>
                        <input type="url" id="affiche" name="affiche" value="<?= $modifFilm["affiche"] ?>" required>
                    </figcaption>
                </figure>

                <!-- Informations du film -->
                <fieldset>
                    <legend>Détails du film</legend>

                    <div role="group">
                        <label for="titre">Titre :</label>
                        <input type="text" id="titre" name="titre" value="<?= $modifFilm["titre_film"] ?>" required>
                    </div>

                    <div role="group">
                        <label for="dateSortie">Date de sortie :</label>
                        <input type="date" id="dateSortie" name="dateSortie" value="<?= $modifFilm["sortieFilm"] ?>" required>
                    </div>

                    <div role="group">
                        <label for="duree">Durée (en minutes) :</label>
                        <input type="number" id="duree" name="duree" value="<?= $modifFilm["duree"] ?>" min="1" required>
                    </div>

                    <div role="group">
                        <label for="note">Note :</label>
                        <input type="number" id="note" name="note" value="<?= $modifFilm["note"] ?>" min="0" max="5" step="0.1" required>
                    </div>

                    <div role="group">
                        <label for="synopsis">Synopsis :</label>
                        <textarea id="synopsis" name="synopsis" rows="5" required><?= $modifFilm["synopsis"] ?></textarea>
                    </div>
                </fieldset>
            </div>

            <div role="group" aria-label="Genres">
                <fieldset>
                    <legend>Genres</legend>
                    <?php foreach($genres as $genre) {?>
                        <div role="group">
                            <input type="checkbox" id="<?= $genre['nom_genre']?>" name="<?= $genre['nom_genre']?>">
                            <label for="<?= $genre['nom_genre']?>"><?= $genre['nom_genre']?></label>
                        </div>
                    <?php } ?>
                </fieldset>
            </div>

            <div role="group" aria-label="Actions">
                <button type="submit">Enregistrer les modifications</button>
                <button type="reset">Réinitialiser</button>
            </div>
        </form>
    </article>
    <aside>
        <div id="realisation">
            <p>Réalisation :</p>
            <div>
                <?php foreach($modifRealisateur as $modifReal) { ?>
                    <div>  
                        <figure>
                            <img src="<?= $modifReal['photo'] ?>" 
                            alt="Photo de <?= $modifReal["realisateur"]?>"
                            >
                        </figure>
                        <h4><?= $modifReal['realisateur'] ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="casting">
            <p>Casting : </p>
            <div>
                <?php foreach($modifCasting as $modifCast) { ?>
                    <div> 
                        <figure>
                            <img src="<?= $modifCast['photo'] ?>" 
                            alt="Photo de <?= $modifCast['acteur'] ?>"
                            >
                        </figure>
                        <h4><?= $modifCast['acteur'] ?></h4>
                        <p>Rôle : <?= $modifCast['nomRole']?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </aside>
</section>
<nav aria-label="Actions sur le film">
    <a href="index.php?action=deleteFilm&id=<?= $modifFilm["id_film"] ?>" role="button">Supprimer</a>
</nav>
<?php

$metaDescription = 
    "On Air. - modification : ".$modifFilm["titre_film"];

$titre = "modification ".$modifFilm["titre_film"];

$contenu = ob_get_clean();
require "view/template.php";