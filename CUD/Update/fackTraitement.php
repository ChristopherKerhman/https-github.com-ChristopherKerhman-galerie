<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idCommande = filter($_POST['idCommande']);
  $requetteSQL = "UPDATE `commandes` SET `statutsCommande`= 2 WHERE `idCommande` = :idCommande";
  $prepare = [['prep'=> ':idCommande', 'variable' => $idCommande]];
  $payerCommande = new CurDB($requetteSQL, $prepare);
  $payerCommande->actionDB();
  header('location:../../index.php?message=Vous venez de payer la commande n°: LNG'.$idCommande.'');
  } else {
    header('location:../../index.php?message=Erreur de traitement');
  }
 ?>
