<?php
require('../include/fonctions.php');
$membre = $_GET['m'];
$infos = charger_infos_membre($membre);
$emprunts = charger_emprunts_membre($membre);
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

        .profile-image {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="container text-center mt-5">
            <h1 class="display-4 fw-bold text-dark mb-3">Profil de <?= $infos['nom'] ?></h1>
            <p class="text-muted">Informations détaillées du membre</p>
        </div>

        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex justify-content-start">
                <a href="objets.php" class="btn btn-outline-secondary">Retour à la liste</a>
            </div>
            <div class="d-flex justify-content-end">
                <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="../assets/images/<?= $infos['image_profil'] ?>" alt="Photo de profil" class="profile-image mb-3">
                        <h5 class="card-title fw-bold"><?= $infos['nom'] ?></h5>
                        <p class="text-muted"><?= $infos['email'] ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Informations personnelles</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text"><strong>Nom :</strong> <?= $infos['nom'] ?></p>
                                <p class="card-text"><strong>Date de naissance :</strong> <?= $infos['date_naissance'] ?></p>
                                <p class="card-text"><strong>Genre :</strong> <?= $infos['genre'] ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><strong>Ville :</strong> <?= $infos['ville'] ?></p>
                                <p class="card-text"><strong>Email :</strong> <?= $infos['email'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Objets empruntés</h5>
                    <?php if (count($emprunts) > 0) { ?>
                        <div class="row g-3">
                            <?php foreach($emprunts as $e) { ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title"><?= $e['nom_objet'] ?></h6>
                                            <p class="card-text text-muted small">
                                                <strong>Catégorie:</strong> <?= $e['nom_categorie'] ?><br>
                                                <strong>Emprunté le:</strong> <?= $e['date_emprunt'] ?><br>
                                                <strong>Retour prévu:</strong> <?= $e['date_retour'] ?>
                                            </p>
                                            <a href="ficheObjet.php?o=<?= $e['id_objet'] ?>" class="btn btn-sm btn-outline-primary">Voir l'objet</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <p class="text-muted">Aucun objet emprunté actuellement.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>