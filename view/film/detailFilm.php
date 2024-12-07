<?php
use Service\Utils;
ob_start();
?>

<div class="detail-header" style="background-image: url('<?= $film["bg"] ?>');">
    <div class="overlay"></div>
    <div class="detail-content">
        <div class="detail-poster">
            <img src="<?= $film["affiche"] ?>" alt="<?= $film["titre_film"] ?>" class="poster-img">
        </div>
        <div class="detail-info">
            <h1><?= $film["titre_film"] ?></h1>
            <div class="meta-info">
                <span class="meta-item"><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                <span class="meta-item"><?= $film["duree"] ?> min</span>
                <span class="meta-item"><?= $film["genre"] ?></span>
                <span class="meta-item rating"><?= $film["note"] ?>/5</span>
            </div>
            <p class="synopsis"><?= $film["synopsis"] ?></p>
        </div>
    </div>
</div>

<div class="detail-sections">
    <section class="credits-section">
        <h2>Réalisation</h2>
        <div class="credits-grid">
            <?php foreach($realisateur as $real) { ?>
            <div class="credit-card">
                <a href="index.php?action=detailRealisateur&id=<?= $real["id_realisateur"] ?>">
                    <img src="<?= $real["photo"] ?>" alt="<?= $real["realisateur"] ?>">
                    <div class="credit-info">
                        <h3><?= $real["realisateur"] ?></h3>
                        <p>Réalisateur</p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>

    <section class="credits-section">
        <h2>Distribution</h2>
        <div class="credits-grid">
            <?php foreach($casting as $cast) { ?>
            <div class="credit-card">
                <a href="index.php?action=detailActeur&id=<?= $cast["id_acteur"] ?>">
                    <img src="<?= $cast["photo"] ?>" alt="<?= $cast["acteur"] ?>">
                    <div class="credit-info">
                        <h3><?= $cast["acteur"] ?></h3>
                        <p><?= $cast["nomRole"] ?></p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>
</div>

<div class="action-buttons">
    <a href="index.php?action=editFilm&id=<?= $film["id_film"] ?>" class="btn-edit">Modifier</a>
</div>

<?php
$titre = $film["titre_film"];
$metaDescription = "On Air. - " . $film["titre_film"] . " : " . substr($film["synopsis"], 0, 150) . "...";
$contenu = ob_get_clean();
require "view/template.php";
?>