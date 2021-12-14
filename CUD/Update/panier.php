<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
include '../../commerce/readCommande.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $idNav = filter($_POST['idNav']);
    $idCommande = filter($_POST['idCommande']);
    $requetteSQL = "SELECT SUM(`prixHT`) AS `total` FROM `detailCommande` WHERE `idDevis` = :idCommande";
    $prepare = [['prep'=> ':idCommande', 'variable' => $idCommande]];
    $totalCommande = readCommande($requetteSQL, $prepare);
    $requetteSQL = "UPDATE `commandes` SET `statutsCommande`= 1, `prixHT` = :prixHT WHERE `idCommande` = :idCommande";
    $prepare = [['prep'=> ':idCommande', 'variable' => $idCommande],
                ['prep'=> ':prixHT', 'variable' => $totalCommande[0]['total']]];
    $delArticle = new CurDB($requetteSQL, $prepare);
    $delArticle->actionDB();
    header('location:../../index.php?idNav='.$idNav.' & message=Vous avez validé votre panier.');
  } else {
    header('location:../../index.php?message=Erreur');
  }
 ?>
