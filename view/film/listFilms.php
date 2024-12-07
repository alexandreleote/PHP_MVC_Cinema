<?php
use Service\Utils;
ob_start();
?>

<div class="list-container">
    <div class="page-banner banner-films">
        <div class="banner-content">
            <h1>Films</h1>
            <p><strong><?= count($films) ?></strong> Film<?= count($films) > 1 ? "s" : "" ?></p>
        </div>
        <div class="banner-content">
            <a href="index.php?action=addFilm" class="add-button">Ajouter un Film</a>
        </div>
    </div>

    <div class="cards-grid">
        <?php foreach($films as $film) { ?>
        <div class="card">
            <img src="<?= $film["affiche"] ?>" alt="<?= $film["titre_film"] ?>" class="card-image">
            <div class="card-content">
                <h3 class="card-title"><?= $film["titre_film"] ?></h3>
                <div class="card-meta">
                    <span class="card-duration"><?= Utils::formatDuration($film["duree"]) ?></span>
                    <span class="card-year"><?= Utils::formatDate($film["sortieFilm"], "") ?></span>
                </div>
            </div>
            <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>" class="card-link"></a>
        </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Liste des Films";
$metaDescription = "On Air. - Découvrez tous nos films, leurs acteurs et réalisateurs.";
$contenu = ob_get_clean();
require "view/template.php";
?>