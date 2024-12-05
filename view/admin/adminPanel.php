<?php ob_start(); ?>

<article class="admin-panel">
    <h2>Panneau Admin</h2>
    <div class="admin-actions">
        <a href="index.php?action=addFilm" class="btn btn-primary">Ajouter un Film</a>
        <a href="index.php?action=addGenre" class="btn btn-primary">Ajouter un Genre</a>
    </div>
</article>

<?php
$titre = "Panneau Admin";
$metaDescription = "Panneau d'administration";
$contenu = ob_get_clean();
require "view/template.php";
?>