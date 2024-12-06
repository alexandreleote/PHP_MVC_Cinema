<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<div class="container">
    <div class="actor-content">
        <!-- Premier bloc : Informations personnelles -->
        <div class="person-info-block">
            <div class="person-main-info">
                <img src="<?= $details["photo"] ?>" alt="Photo de <?= $details["acteur"] ?>" class="person-image">
                <div class="person-details">
                    <h1><?= $details["acteur"] ?></h1>
                    <p class="person-meta">Métier(s) : <?= Utils::getMetiers($details) ?></p>
                    <p class="person-meta">Naissance : <?= Utils::formatDate($details["dateNaissance"], "") ?></p>
                    <?php if (!empty($details["dateMort"])) { ?>
                        <p class="person-meta">Décès : <?= Utils::formatDate($details["dateMort"], "") ?></p>
                    <?php } ?>
                    <p class="person-meta">Âge : <?= Utils::getAge($details["dateNaissance"], $details["dateAge"])?> ans</p>
                </div>
            </div>
            <?php if (!empty($details["bio"])) { ?>
                <div class="person-bio">
                    <h2>Biographie</h2>
                    <p><?= $details["bio"]?></p>
                </div>
            <?php } ?>
        </div>

        <!-- Deuxième bloc : Filmographie -->
        <div class="filmography-block">
            <h2>Filmographie</h2>
            <div class="filmography-grid">
                <?php foreach($filmographie as $film) { ?>
                    <div class="film-card">
                        <div class="overlay"></div>
                        <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>">
                            <img src="<?= $film["affiche"] ?>" alt="Affiche de <?= $film["titre_film"] ?>" class="film-poster">
                            <div class="film-info">
                                <h3><?= $film["titre_film"] ?></h3>
                                <p class="role">Rôle : <?= $film["nomRole"] ?></p>
                                <p class="year"><?= $film["annee_sortie"] ?></p>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Bouton de modification -->
<aside class="sticky-edit-button">
    <a href="index.php?action=editActeur&id=<?= $details["id_acteur"] ?>" class="btn-primary">Modifier</a>
</aside>

<?php
$titre = $details["acteur"];
$metaDescription = "On Air. - ".$details["acteur"]." : toutes les informations à son sujet. Filmographie, best-sellers...";
$contenu = ob_get_clean();
require "view/template.php";
?>