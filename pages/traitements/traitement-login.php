<?php
require('../../include/fonctions.php');

if (!isset($_POST['email']) || !isset($_POST['mdp'])) {
    header('Location: ../login.php?erreur=1');
    exit;
}

$infos = login($_POST['email'], $_POST['mdp']);
if ($infos == -1) {
    header('Location: ../login.php?erreur=1');
    exit;
}

session_start();
$_SESSION['id_membre'] = $infos['id_membre'];
$_SESSION['nom'] = $infos['nom'];
$_SESSION['email'] = $infos['email'];
$_SESSION['genre'] = $infos['genre'];
$_SESSION['ville'] = $infos['ville'];
header('Location: ../objets.php');