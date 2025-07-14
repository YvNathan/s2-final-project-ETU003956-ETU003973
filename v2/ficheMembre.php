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
    <?php
        foreach($fiche as $f){
            
        }
    ?>
</body>
</html>