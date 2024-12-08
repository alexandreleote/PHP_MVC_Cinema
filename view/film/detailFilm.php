<?php
use Service\Utils;
ob_start();

// Ensure background image exists and has a valid path
$bgImage = !empty($film["bg"]) ? $film["bg"] : 'public/images/default-bg.jpg';
$posterImage = !empty($film["affiche"]) ? $film["affiche"] : 'public/images/default-poster.jpg';
?>

<section class="film-detail-container">
    <article class="film-header" style="background-image: url('<?= ($bgImage) ?>');">
        <div class="film-content">
            <div class="film-poster-container">
                <img src="<?= ($posterImage) ?>" alt="<?= ($film["titre_film"]) ?>" class="film-poster">
            </div>
            <div class="film-info">
                <h1 class="film-title"><?= ($film["titre_film"]) ?></h1>
                <div class="film-meta detail-info-row">
                    <span><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                    <span><?= $film["duree"] ?> min</span>
                    <span><?= $film["genre"] ?></span>
                    <span class="rating"><?= $film["note"] ?>/5</span>
                </div>
                <p class="film-synopsis"><?= ($film["synopsis"]) ?></p>
            </div>
        </div>
    </article>

    <section class="film-credits">
        <article class="credits-section directors">
            <h2 class="credits-title">Réalisation</h2>
            <div class="credits-grid">
                <?php foreach($realisateur as $real) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailRealisateur&id=<?= $real["id_realisateur"] ?>">
                        <img src="<?= ($real["photo"]) ?>" alt="<?= ($real["realisateur"]) ?>">
                        <div class="credit-info">
                            <h3><?= ($real["realisateur"]) ?></h3>
                            <p>Réalisateur</p>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>

        <article class="credits-section cast">
            <h2 class="credits-title">Distribution</h2>
            <div class="credits-grid">
                <?php foreach($casting as $cast) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailActeur&id=<?= $cast["id_acteur"] ?>">
                        <img src="<?= ($cast["photo"]) ?>" alt="<?= ($cast["acteur"]) ?>">
                        <div class="credit-info">
                            <h3><?= ($cast["acteur"]) ?></h3>
                            <p><?= ($cast["nomRole"]) ?></p>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>
    </section>

    <a href="index.php?action=editFilm&id=<?= $film["id_film"] ?>" class="btn-edit">Modifier</a>
</section>

<?php
$titre = $film["titre_film"];
$metaDescription = "On Air. - " . $film["titre_film"] . " : " . substr($film["synopsis"], 0, 150) . "...";
$contenu = ob_get_clean();
require "view/template.php";
?>