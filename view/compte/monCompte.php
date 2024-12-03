<?php

ob_start();

?>
<article>




</article>
<aside>
    <form action="index.php?action=modifyContent" method="post">
        <label for="film-list">Liste des films : </label>
        <select name="film-list" id="film-list">
            <?php
                foreach($films as $film) { ?>
                    <option value="<?= $film["id_film"]?>"><?= $film["titre_film"] ?></option>
            <?php } ?>
        </select>

    </form>
    <button><a href="index.php?action=modifyContent&id=<?= $film["id_film"] ?>">Modifier Genre</a></button>
</aside>
<?php

$metaDescription =
    "On Air. - Panneau Admin";

$titre = "Mon Compte";
$contenu = ob_get_clean();
require "view/template.php";