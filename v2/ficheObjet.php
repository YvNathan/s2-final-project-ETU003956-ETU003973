<?php
require('../include/fonctions.php');
session_start();
$objet = $_GET['o'];
$fiche = charger_fiche_objet($objet);
$histo = charger_histo_emprunts($objet);
$images = charger_images_objet($objet);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-link:hover {
            text-decoration: none;
            color: inherit;
        }

        .card-img-top {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .object-image {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0.375rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="container text-center mt-5">
            <h1 class="display-4 fw-bold text-dark mb-3">Détails sur <?= $fiche['nom_objet'] ?></h1>
            <p class="text-muted">Informations détaillées de l'objet</p>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex justify-content-start">
                <a href="objets.php" class="btn btn-outline-secondary">Retour à la liste</a>
            </div>
            <div class="d-flex justify-content-end">
                <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
            </div>
        </div>

        <?php if ($fiche['id_membre'] == $_SESSION['id_membre']) { ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Ajouter des photos</h5>
                    <form action="traitements/traitement-ajout-photo.php" method="post" enctype="multipart/form-data" class="row g-3">
                        <input type="hidden" name="id_objet" value="<?= $fiche['id_objet'] ?>">
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="fichier[]" id="fichier" multiple accept="image/*" required>
                            <div class="form-text">Formats acceptés : JPG, JPEG, PNG, GIF (max 25MB par image)</div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Ajouter les photos</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Images de l'objet</h5>
                        <div class="row g-2">
                            <?php foreach ($images as $image) { ?>
                                <div class="col-md-6">
                                    <img src="../assets/images/<?= $image ?>" alt="Photo objet" class="object-image">
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Informations</h5>
                        <p class="card-text"><strong>Nom :</strong> <?= $fiche['nom_objet'] ?></p>
                        <p class="card-text"><strong>Catégorie :</strong> <?= $fiche['nom_categorie'] ?></p>
                        <p class="card-text"><strong>Propriétaire :</strong> <?= $fiche['nom'] ?></strong></p>
                        <?php if (is_array($emprunt = retrouver_dans_emprunts($fiche['id_objet']))) { ?>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-info">
                                    <i class="bi bi-calendar-check"></i> Emprunté le: <?= $emprunt['date_emprunt'] ?>
                                </span>
                                <span class="badge bg-warning">
                                    <i class="bi bi-calendar-x"></i> Retour: <?= $emprunt['date_retour'] ?>
                                </span>
                            </div>
                        <?php } else { ?>
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Disponible
                            </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Historique des emprunts</h5>
                    <?php if (count($histo) > 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Date Emprunt</th>
                                        <th>Date Retour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($histo as $h) { ?>
                                        <tr>
                                            <td><?= $h['nom'] ?></td>
                                            <td><?= $h['date_emprunt'] ?></td>
                                            <td><?= $h['date_retour'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p class="text-muted">Aucun emprunt enregistré pour cet objet.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>