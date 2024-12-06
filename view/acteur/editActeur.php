<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<div class="container">
    <div class="actor-content">
        <form action="index.php?action=updateActeur&id=<?= $details["id_acteur"] ?>" method="POST" class="edit-form">
            <!-- Premier bloc : Informations personnelles -->
            <div class="person-info-block">

                <!-- Informations personnelles -->
                <div class="person-main-info">

                    <!-- Photo -->
                    <div class="form-image-container">
                        <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["acteur"] ?>" class="person-image">
                        <div class="form-group">
                            <label for="photo">Photo (URL) :</label>
                            <input type="url" id="photo" name="photo" value="<?= $details["photo"] ?>" required>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="person-details">

                        <!-- Prénom -->
                        <div class="form-group">
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="<?= $details["prenom_personne"] ?>" required>
                        </div>

                        <!-- Nom -->
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="<?= $details["nom_personne"] ?>" required>
                        </div>

                        <!-- Genre -->
                        <div class="form-group">
                            <label>Genre :</label>
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" id="homme" name="genre" value="Homme" <?= $details["genre"] === "Homme" ? "checked" : "" ?> required>
                                    <label for="homme">Homme</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="femme" name="genre" value="Femme" <?= $details["genre"] === "Femme" ? "checked" : "" ?> required>
                                    <label for="femme">Femme</label>
                                </div>
                            </div>
                        </div>

                        <!-- Date de naissance -->
                        <div class="form-group">
                            <label for="dateNaissance">Date de naissance :</label>
                            <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $details["dateNaissance"] ?>" required>
                        </div>

                        <!-- Date de décès -->
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" id="estVivant" name="estVivant" <?= empty($details["dateMort"]) ? "checked" : "" ?>>
                                <label for="estVivant">Est toujours vivant</label>
                            </div>

                            <div class="date-mort-container" style="<?= empty($details["dateMort"]) ? 'display: none;' : '' ?>">
                                <label for="dateMort">Date de décès :</label>
                                <input type="date" id="dateMort" name="dateMort" value="<?= $details["dateMort"] ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Métiers -->
                <div class="form-group">
                    <label>Métiers :</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="acteur" name="metiers[]" value="acteur" <?= isset($details["metiers"]) && in_array("acteur", $details["metiers"]) ? "checked" : "" ?>>
                            <label for="acteur"><?= $details["genre"] === "Homme" ? "Acteur" : "Actrice" ?></label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="realisateur" name="metiers[]" value="realisateur" <?= isset($details["metiers"]) && in_array("realisateur", $details["metiers"]) ? "checked" : "" ?>>
                            <label for="realisateur"><?= $details["genre"] === "Homme" ? "Réalisateur" : "Réalisatrice" ?></label>
                        </div>
                    </div>
                </div>

                <!-- Biographie -->
                <div class="form-group">
                    <label for="bio">Biographie :</label>
                    <textarea id="bio" name="bio" rows="5"><?= $details["bio"] ?></textarea>
                </div>
            </div>

            <!-- Deuxième bloc : Filmographie -->
            <div class="filmography-block">
                <h2>Filmographie</h2>
                <div class="filmography-edit-grid">
                    <?php foreach($filmographie as $film) { ?>
                        <div class="film-edit-card">
                            <div class="film-poster-container">
                                <img src="<?= $film["affiche"] ?>" alt="Affiche de <?= $film["titre_film"] ?>" class="film-poster-small">
                                <h3><?= $film["titre_film"] ?></h3>
                            </div>
                            <div class="form-group">
                                <label for="role_<?= $film["id_film"] ?>">Rôle :</label>
                                <input type="text" id="role_<?= $film["id_film"] ?>" name="roles[<?= $film["id_film"] ?>]" value="<?= $film["nomRole"] ?>">
                                <button type="button" class="btn-remove" data-film-id="<?= $film["id_film"] ?>">Retirer ce film</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Boutons d'enregistrement / réinitialisation -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                <button type="reset" class="btn-secondary">Réinitialiser</button>
            </div>
        </form>
    </div>
</div>

<!-- Bouton de suppression -->
<aside class="sticky-edit-button">
    <a href="index.php?action=deleteActeur&id=<?= $details["id_acteur"] ?>" class="btn-primary">Supprimer</a>
</aside>

<?php
$titre = "Modifier : " . $details["acteur"];
$metaDescription = "Modification des informations de " . $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";
?>