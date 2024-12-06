<?php
ob_start();
?>

<section class="form-container">
    <header class="form-header">
        <h1>Ajouter un Film</h1>
    </header>

    <form action="index.php?action=addFilm" method="post" class="form">
        <div class="form-group">
            <label for="titre">Titre du film</label>
            <input type="text" name="titre" id="titre" required>
        </div>

        <div class="form-group">
            <label for="annee_sortie">Année de sortie</label>
            <input type="number" name="annee_sortie" id="annee_sortie" min="1895" max="<?= date('Y') ?>" required>
        </div>

        <div class="form-group">
            <label for="duree">Durée (en minutes)</label>
            <input type="number" name="duree" id="duree" min="1" required>
        </div>

        <div class="form-group">
            <label for="synopsis">Synopsis</label>
            <textarea name="synopsis" id="synopsis" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="note">Note</label>
            <input type="number" name="note" id="note" min="0" max="5" step="0.5" required>
        </div>

        <div class="form-group">
            <label for="id_realisateur">Réalisateur</label>
            <select name="id_realisateur" id="id_realisateur" required>
                <option value="">Sélectionner un réalisateur</option>
                <?php foreach($realisateurs as $realisateur) { ?>
                    <option value="<?= $realisateur['id_realisateur'] ?>"><?= $realisateur['realisateur'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Genres</label>
            <div class="checkbox-group">
                <?php foreach($genres as $genre) { ?>
                    <div class="checkbox-item">
                        <input type="checkbox" name="genres[]" id="genre_<?= $genre['id_genre'] ?>" value="<?= $genre['id_genre'] ?>">
                        <label for="genre_<?= $genre['id_genre'] ?>"><?= $genre['libelle'] ?></label>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Ajouter le film</button>
        </div>
    </form>
</section>

<?php
$titre = "Ajouter un Film";
$metaDescription = "On Air. - Ajoutez un nouveau film à notre catalogue.";
$contenu = ob_get_clean();
require "view/template.php";
?>
