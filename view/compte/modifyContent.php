<?php

ob_start();

?>
<article>




</article>
<aside>
    <button><a href="index.php?action=monCompte">Retour</a></button>
</aside>
<?php

$metaDescription =
    "On Air. - Panneau Admin";

$titre = "Mon Compte";
$contenu = ob_get_clean();
require "view/template.php";