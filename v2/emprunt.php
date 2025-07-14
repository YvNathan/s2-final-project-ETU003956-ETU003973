<?php
require('../include/fonctions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' || !isset($_POST['id_objet'])) {
    header('Location: objets.php');
    exit;
}

$id_objet = $_POST['id_objet'];
$fiche = charger_fiche_objet($id_objet);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP-22-DB</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: cadetblue;
        }
    </style>
</head>

<body class="bg-light">
    <header class="fixed">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold me-4" href="index.php">Tairo ampiasaiko</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="objets.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recherche.php">Recherche</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-3 min-vh-100">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h2 class="card-title mb-0">Emprunter un objet</h2>
            </div>
            <div class="card-body">
                <?php if ($fiche) { ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h5 class="mb-1">Objet sélectionné</h5>
                                <p class="mb-0"><strong><?= htmlspecialchars($fiche['nom_objet'] ?? 'Nom non disponible') ?></strong></p>
                                <?php if (isset($fiche['description'])) { ?>
                                    <small class="text-muted"><?= htmlspecialchars($fiche['description']) ?></small>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <form action="traitements/traitement-emprunt.php" method="post">
                    <input type="hidden" name="id_objet" value="<?= $id_objet?>">
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="duree" class="form-label fw-semibold">Durée de l'emprunt (en jours)</label>
                            <input type="number" name="duree" id="duree" class="form-control" 
                                   placeholder="Nombre de jours" min="1" max="30" required>
                            <div class="form-text">Durée maximale : 30 jours</div>
                        </div>

                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="objets.php" class="btn btn-outline-secondary me-md-2">
                                    <i class="bi bi-arrow-left"></i> Retour à la liste
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Confirmer l'emprunt
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; Copyright 2025</p>
            <p class="mb-0">ETU003956 - ETU003973</p>
        </div>
    </footer>
</body>

</html>