<?php

ob_start();

?>
<article>
    <figure>
        <img src="<?= $films["affiche"] ?>" alt="Affiche du film : <?= $films["titre_film"] ?>">
    </figure>
    <h3> <?= $films["titre_film"] ?> </h3>



</article>
<aside>
   
</aside>
<?php

$metaDescription =
    "On Air. - Panneau Admin";

$titre = "Mon Compte";
$contenu = ob_get_clean();
require "view/template.php";