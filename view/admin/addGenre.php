<?php ob_start(); ?>

<div class="admin-container">
    <div class="form-container">
        <h2>Ajouter un Genre</h2>
        
        <form action="index.php?action=addGenre" method="post" class="admin-form">
            <div class="form-group">
                <label for="nomGenre">Nom du genre</label>
                <input type="text" name="nomGenre" id="nomGenre" placeholder="Entrez un nom de genre" required>
            </div>
            
            <div class="admin-actions">
                <input type="submit" value="Ajouter le genre" class="btn-primary">
            </div>
        </form>
    </div>
</div>

<?php
$titre = "Ajouter un Genre";
$metaDescription = "Ajouter un nouveau genre de film - On Air.";
$contenu = ob_get_clean();
require "view/template.php";
?>
