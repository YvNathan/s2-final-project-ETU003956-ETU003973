<?php
require('../include/fonctions.php');
$objet = $_GET['o'];
$fiche = charger_fiche_objet($objet);
$histo = charger_histo_emprunts($objet);
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
    <img src="../assets/images/<?= $fiche['nom_image']?>" alt="">
    <?php
        foreach($histo as $h){?>
            <?= $h['nom']?> 
            <?= $h['date_emprunt']?>
            <?= $h['date_retour']?>
    <?php }?>
</body>
</html>