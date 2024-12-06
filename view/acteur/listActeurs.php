<?php
use Service\Utils;
ob_start();
?>

<section class="list-container">
    <header class="list-header">
        <h1>Liste des Acteurs</h1>
        <p class="list-count"><?= count($acteurs) ?> Acteur<?= count($acteurs) > 1 ? "s" : "" ?></p>
        <div class="list-actions">
            <a href="index.php?action=addActeur" class="btn-primary">Ajouter un Acteur</a>
        </div>
    </header>

    <div class="list-grid">
        <?php foreach($acteurs as $acteur) { ?>
            <article class="list-card" style="background-image: url('<?= $acteur["photo"] ?>');">
                <a href="index.php?action=detailActeur&id=<?= $acteur['id_acteur'] ?>" class="list-card-link">
                    <div class="list-card-content">
                        <h2 class="list-card-title"><?= $acteur["acteur"] ?></h2>
                    </div>
                </a>
            </article>
        <?php } ?>
    </div>
</section>

<?php
$titre = "Liste des Acteurs";
$metaDescription = "On Air. - Découvrez tous nos acteurs et leurs films.";
$contenu = ob_get_clean();
require "view/template.php";
?>