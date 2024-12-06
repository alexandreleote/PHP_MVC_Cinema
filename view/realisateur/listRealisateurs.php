<?php
use Service\Utils;
ob_start();
?>

<section class="list-container">
    <header class="list-header">
        <h1>Liste des Réalisateurs</h1>
        <p class="list-count"><?= count($realisateurs) ?> Réalisateur<?= count($realisateurs) > 1 ? "s" : "" ?></p>
        <div class="list-actions">
            <a href="index.php?action=addRealisateur" class="btn-primary">Ajouter un Réalisateur</a>
        </div>
    </header>

    <div class="list-grid">
        <?php foreach($realisateurs as $realisateur) { ?>
            <article class="list-card" style="background-image: url('<?= $realisateur["photo"] ?>');">
                <a href="index.php?action=detailRealisateur&id=<?= $realisateur['id_realisateur'] ?>" class="list-card-link">
                    <div class="list-card-content">
                        <h2 class="list-card-title"><?= $realisateur["realisateur"] ?></h2>
                    </div>
                </a>
            </article>
        <?php } ?>
    </div>
</section>

<?php
$titre = "Liste des Réalisateurs";
$metaDescription = "On Air. - Découvrez tous nos réalisateurs et leurs films.";
$contenu = ob_get_clean();
require "view/template.php";
?>