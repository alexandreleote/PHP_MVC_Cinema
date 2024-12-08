<?php
use Service\Utils;
ob_start();

?>

<section class="film-detail-container">
    <article class="film-header" style="background-image: url('<?= $details["bg"] ?>');">
        <div class="film-content">
            <div class="film-poster-container">
                <img src="<?= $details["photo"] ?>" alt="<?= $details["acteur"] ?>" class="film-poster">
            </div>
            <div class="film-info">
                <h1 class="film-title"><?= $details["acteur"] ?></h1>
                <div class="film-meta detail-info-row">
                    <span>Né<?= $details["genre"] === "Femme" ? "e" : "" ?> le <?= Utils::formatDate($details["dateNaissance"], "") ?></span>
                    <?php if ($details["dateMort"]) { ?>
                        <span>Décédé<?= $details["genre"] === "Femme" ? "e" : "" ?> le <?= Utils::formatDate($details["dateMort"], "") ?></span>
                    <?php } ?>
                    <span><?= Utils::getMetiers($details) ?></span>
                    <span>Âge : <?= Utils::getAge($details["dateNaissance"], $details["dateMort"]) ?> ans</span>
                    <span>Nombre de films : <?= count($filmographie) ?></span>
                </div>
                <?php if (!empty($details["bio"])) { ?>
                    <p class="film-synopsis"><?= ($details["bio"]) ?></p>
                <?php } ?>
            </div>
        </div>
    </article>

    <section class="film-credits">
        <article class="credits-section filmography">
            <h2 class="credits-title">Filmographie</h2>
            <div class="credits-grid">
                <?php foreach($filmographie as $film) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>">
                        <img src="<?= ($film["affiche"]) ?>" alt="<?= ($film["titre_film"]) ?>">
                        <div class="credit-info">
                            <h3><?= ($film["titre_film"]) ?></h3>
                            <p><?= ($film["nomRole"]) ?></p>
                            <span class="card-year"><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>
    </section>

    <a href="index.php?action=editActeur&id=<?= $details["id_acteur"] ?>" class="btn-edit">Modifier</a>
</section>

<?php
$titre = "Détail de l'acteur - " . $details["acteur"];
$metaDescription = "On Air. - Découvrez la filmographie complète de " . $details["acteur"];
$contenu = ob_get_clean();
require "view/template.php";
?>