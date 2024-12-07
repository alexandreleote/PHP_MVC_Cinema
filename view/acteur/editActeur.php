<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<div>
    <div>
        <form action="index.php?action=updateActeur&id=<?= $details["id_acteur"] ?>" method="POST">
            <!-- Premier bloc : Informations personnelles -->
            <div>
                <!-- Informations personnelles -->
                <div>
                    <!-- Photo -->
                    <div>
                        <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["acteur"] ?>">
                        <div>
                            <label for="photo">Photo (URL) :</label>
                            <input type="url" id="photo" name="photo" value="<?= $details["photo"] ?>" required>
                        </div>
                    </div>

                    <!-- Details -->
                    <div>
                        <!-- Prénom -->
                        <div>
                            <label for="prenom">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" value="<?= $details["prenom_personne"] ?>" required>
                        </div>

                        <!-- Nom -->
                        <div>
                            <label for="nom">Nom :</label>
                            <input type="text" id="nom" name="nom" value="<?= $details["nom_personne"] ?>" required>
                        </div>

                        <!-- Genre -->
                        <div>
                            <label>Genre :</label>
                            <div>
                                <div>
                                    <input type="radio" id="homme" name="genre" value="Homme" <?= $details["genre"] === "Homme" ? "checked" : "" ?> required>
                                    <label for="homme">Homme</label>
                                </div>
                                <div>
                                    <input type="radio" id="femme" name="genre" value="Femme" <?= $details["genre"] === "Femme" ? "checked" : "" ?> required>
                                    <label for="femme">Femme</label>
                                </div>
                            </div>
                        </div>

                        <!-- Date de naissance -->
                        <div>
                            <label for="dateNaissance">Date de naissance :</label>
                            <input type="date" id="dateNaissance" name="dateNaissance" value="<?= $details["dateNaissance"] ?>" required>
                        </div>

                        <!-- Date de décès -->


                <!-- Métiers -->
                <div>
                    <label>Métiers :</label>
                    <div>
                        <div>
                            <input type="checkbox" id="acteur" name="metiers[]" value="acteur" <?= isset($details["metiers"]) && in_array("acteur", $details["metiers"]) ? "checked" : "" ?>>
                            <label for="acteur"><?= $details["genre"] === "Homme" ? "Acteur" : "Actrice" ?></label>
                        </div>
                        <div>
                            <input type="checkbox" id="realisateur" name="metiers[]" value="realisateur" <?= isset($details["metiers"]) && in_array("realisateur", $details["metiers"]) ? "checked" : "" ?>>
                            <label for="realisateur"><?= $details["genre"] === "Homme" ? "Réalisateur" : "Réalisatrice" ?></label>
                        </div>
                    </div>
                </div>

                <!-- Biographie -->
                <div>
                    <label for="bio">Biographie :</label>
                    <textarea id="bio" name="bio" rows="5"><?= $details["bio"] ?></textarea>
                </div>
            </div>

            <!-- Deuxième bloc : Filmographie -->
            <div>
                <h2>Filmographie</h2>
                <div>
                    <?php foreach($filmographie as $film) { ?>
                        <div>
                            <div>
                                <img src="<?= $film["affiche"] ?>" alt="Affiche de <?= $film["titre_film"] ?>">
                                <h3><?= $film["titre_film"] ?></h3>
                            </div>
                            <div>
                                <label for="role_<?= $film["id_film"] ?>">Rôle :</label>
                                <input type="text" id="role_<?= $film["id_film"] ?>" name="roles[<?= $film["id_film"] ?>]" value="<?= $film["nomRole"] ?>">
                                <button type="button" data-film-id="<?= $film["id_film"] ?>">Retirer ce film</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Boutons d'enregistrement / réinitialisation -->
            <div>
                <button type="submit">Enregistrer les modifications</button>
                <button type="reset">Réinitialiser</button>
            </div>
        </form>
    </div>
</div>

<!-- Bouton de suppression -->
<aside>
    <a href="index.php?action=deleteActeur&id=<?= $details["id_acteur"] ?>">Supprimer</a>
</aside>

<?php
$titre = "Modifier : " . $details["acteur"];
$metaDescription = "Modification des informations de " . $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";
?>