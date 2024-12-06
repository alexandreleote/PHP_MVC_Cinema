<?php
use Service\Utils;
ob_start();
?>

<!-- Contenu de la page -->
<section class="list-container">
    <header class="list-header">
        <h1>Liste des Films</h1>
        <p class="list-count"><?= count($films) ?> Film<?= count($films) > 1 ? "s" : "" ?></p>
        <div class="list-actions">
            <a href="index.php?action=addFilm" class="btn-primary">Ajouter un Film</a>
        </div>
    </header>

    <!-- Liste des Films -->
    <div class="list-grid">
        <?php foreach($films as $film) { ?>
            <div class="film-card">
                <div class="overlay"></div>
                <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>">
                    <img src="<?= $film["affiche"] ?>" alt="Affiche de <?= $film["titre_film"] ?>" class="film-poster">
                    <div class="film-info">
                        <h3><?= $film["titre_film"] ?></h3>
                        <p class="year"><?= Utils::formatDate($film["sortieFilm"], "") ?></p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</section>

<?php
$titre = "Liste des Films";
$metaDescription = "On Air. - Découvrez tous nos films, leurs acteurs et réalisateurs.";
$contenu = ob_get_clean();
require "view/template.php";
?>