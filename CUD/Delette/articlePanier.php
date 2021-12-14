<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $idNav = filter($_POST['idNav']);
    $idArticle = filter($_POST['idArticle']);
    $requetteSQL = "DELETE FROM `detailCommande` WHERE `idArticle` = :idArticle";
    $prepare = [['prep'=> ':idArticle', 'variable' => $idArticle]];
    $delArticle = new CurDB($requetteSQL, $prepare);
    $delArticle->actionDB();
    header('location:../../index.php?idNav='.$idNav.' & message=Vous avez effacer une oeuvre de votre panier.');
  } else {
    header('location:../../index.php?message=Erreur');
  }
 ?>
