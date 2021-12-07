<?php
include 'administration/securite.php';
$idUser = filter($_GET['idUser']);
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`
FROM `users`
WHERE `idUser` = :idUser";
$parametreUser = [['prep'=> ':idUser', 'variable' => $idUser]];
$readFicheUser = new readDB($requetteSQL, $parametreUser);
$dataUser = $readFicheUser->read();
require 'objets/ficheUser.php';
$affichage = new ficheUser ($dataUser);
$affichage->fiche();

 ?>
