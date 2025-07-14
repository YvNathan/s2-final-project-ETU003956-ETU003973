<?php
require('../include/fonctions.php');
$membres = charger_liste_membres();
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

        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .card-img-top {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .profile-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }
    </style>
</head>

<body>
    <div class="container mt-4 min-vh-100">
        <div class="container text-center mt-5">
            <h1 class="display-4 fw-bold text-dark mb-3">Liste des Membres</h1>
            <p class="text-muted">Système de gestion des membres</p>
        </div>

        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start mb-4">
                <a href="objets.php" class="btn btn-outline-secondary">Retour aux objets</a>
            </div>

            <div class="d-flex justify-content-end mb-4">
                <a href="traitements/deconnexion.php" class="btn btn-outline-danger">Se déconnecter</a>
            </div>
        </div>

        <div class="py-5">
            <div class="row g-4">
                <?php foreach ($membres as $m) { ?>
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="card shadow-sm h-100">
                            <img src="../assets/images/<?= $m['image_profil'] ?>" class="profile-image" alt="Photo de profil">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">
                                    <a href="ficheMembre.php?m=<?= $m['id_membre'] ?>" class="card-link"><?= $m['nom'] ?></a>
                                </h5>
                                <p class="card-text text-muted mb-2">
                                    <i class="bi bi-envelope"></i> <?= $m['email'] ?>
                                </p>
                                <p class="card-text text-muted mb-2">
                                    <i class="bi bi-geo-alt"></i> <?= $m['ville'] ?>
                                </p>
                                <p class="card-text text-muted mb-2">
                                    <i class="bi bi-calendar"></i> <?= $m['date_naissance'] ?>
                                </p>
                                <div class="mt-auto">
                                    <span class="badge bg-<?= $m['genre'] == 'M' ? 'primary' : 'success' ?>">
                                        <?= $m['genre'] == 'M' ? 'Homme' : 'Femme' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; Copyright 2025</p>
            <p class="mb-0">ETU003956 - ETU003973</p>
        </div>
    </footer>
</body>

</html>