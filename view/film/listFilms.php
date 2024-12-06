<?php
use Service\Utils;
ob_start();
?>

<section class="list-container">
    <header class="list-header">
        <h1>Liste des Films</h1>
        <p class="list-count"><?= count($films) ?> Film<?= count($films) > 1 ? "s" : "" ?></p>
        <div class="list-actions">
            <a href="index.php?action=addFilm" class="btn-primary">Ajouter un Film</a>
        </div>
    </header>

    <div class="list-grid">
        <?php foreach($films as $film) { ?>
            <article class="list-card" style="background-image: url('<?= $film["affiche"] ?>');">
                <a href="index.php?action=detailFilm&id=<?= $film['id_film'] ?>" class="list-card-link">
                    <div class="list-card-content">
                        <h2 class="list-card-title"><?= $film["titre_film"] ?></h2>
                        <p class="list-card-meta"><?= Utils::formatDate($film["sortieFilm"], "") ?></p>
                    </div>
                </a>
            </article>
        <?php } ?>
    </div>
</section>

<?php
$titre = "Liste des Films";
$metaDescription = "On Air. - Découvrez tous nos films, leurs acteurs et réalisateurs.";
$contenu = ob_get_clean();
require "view/template.php";
?>