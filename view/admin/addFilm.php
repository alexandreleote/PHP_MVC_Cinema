<?php ob_start(); ?>

<article>
    <h2>Ajouter un Film</h2>

    <form action="index.php?action=addFilm" method="post">

        <!-- Titre du film -->
        <label for="titreFilm">
            Titre du film
            <input type="text" id="titreFilm" name="titreFilm" required>
        </label>

        <!-- Affiche du film -->
        <label for="afficheFilm">
            Affiche du film
            <input type="text" id="afficheFilm" name="afficheFilm" placeholder="URL de l'affiche du film" required>
        </label>

        <!-- Durée du film -->
        <label for="dureeFilm">
            Durée du film
            <input type="number" id="dureeFilm" name="dureeFilm" placeholder="Durée en minutes" min="1" max="800" required>
        </label>

        <!-- Realisateur du film -->
        <label for="realisateurFilm">
            Réalisateur du film
            <select id="realisateurFilm" name="realisateurFilm" required>
                <option value="" selected disabled>Sélectionner un réalisateur</option>
                <?php foreach($realisateurs as $realisateur) { ?>
                    <option value="<?= $realisateur['id_realisateur'] ?>"><?= $realisateur['nom'] . " " . $realisateur['prenom'] ?></option>
                <?php } ?>
            </select>
        </label>

        <!-- Date de sortie du film -->
        <label for="dateSortieFilm">
            Date de sortie du film
            <input type="date" id="dateSortieFilm" name="dateSortieFilm" required>
        </label>

        <!-- Note du film -->
        <label for="noteFilm">
            Note du film
            <select id="noteFilm" name="noteFilm" required>
                <option value="" selected disabled>Sélectionner une note</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </label>

        <!-- Genres du film -->
        <label>
            Genres du film
            <div class="checkbox-group">
                <?php foreach($genres as $genre) { ?>
                    <div class="checkbox-item">
                        <input type="checkbox" id="genre<?= $genre['id_genre'] ?>" name="genreFilm[]" value="<?= $genre['id_genre'] ?>">
                        <label for="genre<?= $genre['id_genre'] ?>"><?= $genre['nom_genre'] ?></label>
                    </div>
                <?php } ?>
            </div>
        </label>

        <!-- Synopsis du film -->
        <label for="synopsisFilm">
            Synopsis du film
            <textarea id="synopsisFilm" name="synopsisFilm" required placeholder="Synopsis du film"></textarea>
        </label>

        <input type="submit" value="Ajouter le film">
    </form>
</article>

<?php
$titre = "Ajouter un Film";
$metaDescription = "Formulaire d'ajout de film pour l'administration du cinéma";
$contenu = ob_get_clean();
require "view/template.php";
?>
