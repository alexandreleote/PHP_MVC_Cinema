<?php ob_start(); ?>

<div class="admin-container">
    <div class="form-container">
        <h2>Ajouter un Film</h2>
        
        <form action="index.php?action=addFilm" method="post" class="admin-form">

            <!-- Titre du film -->
            <div class="form-group">
                <label for="titreFilm">Titre du film</label>
                <input type="text" id="titreFilm" name="titreFilm" placeholder="Entrez le titre du film" required>
            </div>

            <!-- Affiche du film -->
            <div class="form-group">
                <label for="afficheFilm">Affiche du film</label>
                <input type="text" id="afficheFilm" name="afficheFilm" placeholder="Entrez l'URL de l'affiche" required>
            </div>

            <!-- Duree du film -->
            <div class="form-group">
                <label for="dureeFilm">Durée du film</label>
                <input type="number" id="dureeFilm" name="dureeFilm" placeholder="Durée en minutes" min="1" max="800" required>
            </div>

            <!-- Realisateur du film -->
            <div class="form-group">
                <label for="realisateurFilm">Réalisateur du film</label>
                <select id="realisateurFilm" name="realisateurFilm" required>
                    <option value="">Sélectionnez un réalisateur</option>
                    <?php foreach($realisateurs as $realisateur) { ?>
                        <option value="<?= $realisateur['id_realisateur'] ?>">
                            <?= $realisateur['realisateur'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Date de sortie du film -->
            <div class="form-group">
                <label for="dateSortieFilm">Date de sortie du film</label>
                <input type="date" id="dateSortieFilm" name="dateSortieFilm" required>
            </div>

            <!-- Note du film -->
            <div class="form-group">
                <label for="noteFilm">Note du film</label>
                <input type="number" step="0.01" id="noteFilm" name="noteFilm" placeholder="Entrez la note du film" min="1" max="5" required>
            </div>

            <!-- Genres du film -->
            <div class="form-group">
                <label>Genres du film</label>
                <div class="checkbox-group">
                    <?php foreach($genres as $genre): ?>
                        <div class="checkbox-item">
                            <input type="checkbox" name="genres[]" id="genre<?= $genre['id_genre'] ?>" value="<?= $genre['id_genre'] ?>">
                            <label for="genre<?= $genre['id_genre'] ?>"><?= $genre['nom_genre'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Synopsis du film -->
            <div class="form-group">
                <label for="synopsisFilm">Synopsis du film</label>
                <textarea id="synopsisFilm" name="synopsisFilm" placeholder="Entrez le synopsis du film" required></textarea>
            </div>

            <!-- Ajouter le film -->
            <div class="admin-actions">
                <input type="submit" value="Ajouter le film" class="btn-primary">
            </div>
        </form>
    </div>
</div>

<?php
$titre = "Ajouter un Film";
$metaDescription = "Ajouter un nouveau film - On Air.";
$contenu = ob_get_clean();
require "view/template.php";
?>
