<?php

ob_start();

?>

<h1>Homepage</h1>

<?php

$metaDescription = "On Air. - La référence cinématographique";

$titre = " Bienvenue";
$contenu = ob_get_clean();
require "template.php";