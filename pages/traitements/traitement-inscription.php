<?php
require("../../include/fonctions.php");


if(!isset($_POST['email']) || !isset($_POST['mdp']))
{
    header('Location: ../inscription.php');
}

$infos = $_POST;
creer_compte($infos['nom'], $infos['dtn'], $infos['genre'], $infos['email'], $infos['ville'], $infos['mdp']);
header('Location: ../login.php');