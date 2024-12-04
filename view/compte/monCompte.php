<?php

ob_start();

?>
<article>




</article>
<aside>
    <form action="index.php?action=modifyContent" method="post">
        <label for="modifyContent">Liste des films : </label>
        <select name="modifyContent" id="modifyContent">
            <?php
                    foreach($films as $film) { ?>
                        <option value="<?= $film["id_film"]?>"><?= $film["titre_film"] ?></option>
                <?php } ?>
        </select>
        <input type="submit" name="modify" value="Modifier Genre" class="btn">
    </form>
</aside>
<?php

$metaDescription =
    "On Air. - Panneau Admin";

$titre = "Mon Compte";
$contenu = ob_get_clean();
require "view/template.php";

