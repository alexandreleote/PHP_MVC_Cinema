<?php
use Service\Utils;
ob_start();

// Extraction du prénom et du nom
$nameParts = explode(' ', $details['acteur'] ?? '', 2);
$prenom = count($nameParts) > 1 ? $nameParts[0] : '';
$nom = count($nameParts) > 1 ? $nameParts[1] : ($nameParts[0] ?? '');
?>

<section class="film-detail-container">
    <article class="film-header" style="background-image: url('<?=  $details['bg'] ?>');">
        <div class="film-content">
            <div class="film-poster-container">
                <img src="<?= $details['photo'] ?? '' ?>" alt="<?= $details['acteur'] ?? '' ?>" class="film-poster">
            </div>

            <div class="film-info">
                <h1 class="film-title"><?= $details['acteur'] ?></h1>
                <div class="film-meta detail-info-row">
                    <span>Né<?= $details['genre'] === "Femme" ? "e" : "" ?> le <?= Utils::formatDate($details['dateNaissance'], "") ?></span>
                    <?php if (isset($details['dateMort']) && $details['dateMort']) { ?>
                        <span>Décédé<?= $details['genre'] === "Femme" ? "e" : "" ?> le <?= Utils::formatDate($details['dateMort'], "") ?></span>
                    <?php } ?>
                    <span><?= Utils::getMetiers($details) ?></span>
                    <span>Âge : <?= Utils::getAge($details['dateNaissance'], $details['dateMort']) ?> ans</span>
                    <span>Nombre de films : <?= count($filmographie) ?></span>
                </div>

                <?php if (!empty($details['bio'])) { ?>
                    <p class="film-synopsis"><?= $details['bio'] ?></p>
                <?php } ?>
            </div>
        </div>
    </article>

    <section class="film-credits">
        <article class="credits-section filmography">
            <h2 class="credits-title">Filmographie</h2>
            <div class="credits-grid">
                <?php foreach($filmographie as $film) { ?>
                <div class="credit-card">
                    <a href="index.php?action=detailFilm&id=<?= $film["id_film"] ?>">
                        <img src="<?= $film["affiche"] ?>" alt="<?= $film["titre_film"] ?>">
                        <div class="credit-info">
                            <h3><?= $film["titre_film"] ?></h3>
                            <p><?= $film["nomRole"] ?></p>
                            <span class="card-year"><?= Utils::formatDate($film["annee_sortie"], "") ?></span>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </article>
    </section>

    <a href="index.php?action=deleteActeur&id=<?= $details['id_acteur'] ?>" class="btn-delete">Supprimer</a>
</section>

<section class="edit-forms-container">
    <h2 class="edit-section-title">Modifier les informations</h2>

    <form action="index.php?action=updateActeur&id=<?= $details['id_acteur'] ?>" method="POST" class="form-edit-acteur">
        <div class="form-container">
            <div class="form-section identite">
                <h2>Identité</h2>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input 
                        type="text" 
                        id="prenom" 
                        name="prenom" 
                        value="<?= $prenom ?>" 
                        placeholder="Prénom"
                    >
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input 
                        type="text" 
                        id="nom" 
                        name="nom" 
                        value="<?= $nom ?>" 
                        placeholder="Nom" 
                        required
                    >
                </div>
                <div class="form-group">
                    <label>Genre</label>
                    <div class="radio-group">
                        <input 
                            type="radio" 
                            id="homme" 
                            name="genre" 
                            value="Homme" 
                            <?= (isset($details['genre']) && $details['genre'] === 'Homme') ? 'checked' : '' ?>
                        >
                        <label for="homme">Homme</label>
                        <input 
                            type="radio" 
                            id="femme" 
                            name="genre" 
                            value="Femme" 
                            <?= (isset($details['genre']) && $details['genre'] === 'Femme') ? 'checked' : '' ?>
                        >
                        <label for="femme">Femme</label>
                    </div>
                </div>
            </div>

            <div class="form-section dates">
                <h2>Dates</h2>
                <div class="form-group">
                    <label for="dateNaissance">Date de Naissance</label>
                    <input 
                        type="date" 
                        id="dateNaissance" 
                        name="dateNaissance" 
                        value="<?= 
                            !empty($details['dateNaissance']) 
                            ? date('Y-m-d', strtotime($details['dateNaissance'])) 
                            : '' 
                        ?>" 
                    >
                </div>
                <div class="form-group">
                    <label for="dateMort">Date de Décès</label>
                    <input 
                        type="date" 
                        id="dateMort" 
                        name="dateMort" 
                        value="<?= 
                            !empty($details['dateMort']) 
                            ? date('Y-m-d', strtotime($details['dateMort'])) 
                            : '' 
                        ?>" 
                    >
                </div>
            </div>

            <div class="form-section details">
                <h2>Détails</h2>
                <div class="form-group">
                    <label for="photo">Photo de Profil</label>
                    <input 
                        type="text" 
                        id="photo" 
                        name="photo" 
                        value="<?= $details['photo'] ?>" 
                        placeholder="URL de la photo"
                    >
                </div>
                <div class="form-group">
                    <label for="bg">Photo de Fond</label>
                    <input 
                        type="text" 
                        id="bg" 
                        name="bg" 
                        value="<?= $details['bg'] ?>" 
                        placeholder="URL de la photo de fond"
                    >
                </div>
                <div class="form-group">
                    <label for="bio">Biographie</label>
                    <textarea 
                        id="bio" 
                        name="bio" 
                        placeholder="Biographie de l'acteur"
                    ><?= $details['bio'] ?></textarea>
                </div>
                <div class="form-group">
                    <label>Métiers</label>
                    <div class="checkbox-group">
                        <div>
                            <input 
                                type="checkbox" 
                                id="acteur" 
                                name="metiers[]" 
                                value="acteur"
                                <?= ($details['id_acteur'] !== null) ? 'checked' : '' ?>
                            >
                            <label for="acteur">Acteur</label>
                        </div>
                        <div>
                            <input 
                                type="checkbox" 
                                id="realisateur" 
                                name="metiers[]" 
                                value="realisateur"
                                <?= ($details['id_realisateur'] !== null) ? 'checked' : '' ?>
                            >
                            <label for="realisateur">Réalisateur</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-edit">Modifier</button>
            </div>
        </div>
    </form>
</section>

<?php
$titre = "Modifier : " . $details['acteur'];
$metaDescription = "Modification des informations de " . $details['acteur'];
$contenu = ob_get_clean();
require "view/template.php";
?>