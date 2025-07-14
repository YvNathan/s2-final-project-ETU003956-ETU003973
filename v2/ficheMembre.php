<?php
require('../include/fonctions.php');
$membre = $_GET['m'];
$fiche = charger_fiche_membre($membre);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S2-Final-project</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <img src="../assets/images/<?= $fiche['image_profil'] ?>" alt="">
    <h2>Détails sur <?= $fiche['nom'] ?></h2>
    <?php
        foreach($fiche as $f){?>
            <tr>
                <td><?= $f['nom']?></td>
                <td><?= $f['date_naissance']?></td>
                <td><?= $f['genre']?></td>
                <td><?= $f['ville']?></td>
                <td><?= $f['email']?></td>
            </tr>
    <?php } ?>
</body>
</html>