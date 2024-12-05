<?php ob_start(); ?>

<article>
    <h2>Panneau Admin</h2>
    <form action="index.php?action=addGenre" method="post">
        <label for="nomGenre">
            Nom du genre :
            <input type="text" name="nomGenre" required>
        </label>
        <input type="submit" value="Ajouter le genre">
    </form>
</article>

<?php
$titre = "Panneau Admin";
$metaDescription = "Panneau d'administration";
$contenu = ob_get_clean();
require "view/template.php";
?>
