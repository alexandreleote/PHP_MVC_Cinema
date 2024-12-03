<?php

ob_start();

?>

<h1>Homepage</h1>

<?php

$metaDescription = "On Air. - La référence cinématographique";

$titre = "Home";
$titre_secondaire = "Home";
$contenu = ob_get_clean();
require "template.php";