<?php
require('../../include/fonctions.php');
session_start();

if (!isset($_POST['id_objet']) || !isset($_POST['duree'])) {
    header('Location: ../emprunt.php');
    exit;
}

$id_objet = $_POST['id_objet'];
$duree = $_POST['duree'];

emprunter_objet($id_objet, $_SESSION['id_membre'], $duree);
header('Location: ../objets.php');
?>