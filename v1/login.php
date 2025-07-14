<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Connexion à Tairo Ampiasaiko</h2>

                        <?php if (isset($_GET['erreur'])) {
                            $erreur = $_GET['erreur'];
                            if ($erreur == 1) { ?>
                                <div class="alert alert-danger" role="alert">
                                    Verifiez vos informations de connexion
                                </div>
                        <?php }
                        } ?>

                        <form action="traitements/traitement-login.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" required />
                            </div>
                            <div class="mb-3">
                                <label for="mdp" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="mdp" name="mdp" required />
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>

                        <div class="row mt-4">
                            <p class="text-center text_muted">Vous n'avez pas de compte ?</p>
                            <a href="inscription.php" class="btn btn-success">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>