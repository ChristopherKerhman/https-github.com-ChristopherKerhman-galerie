<?php
session_start();
include '../CUD/fonctionsDB.php';
require '../objets/paramDB.php';
require '../objets/cud.php';
require '../objets/readDB.php';
include 'statuts.php';
function readCommande ($SQL, $data) {
  $read = new readDB($SQL, $data);
  return $read->read();
}
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idOeuvre = filter($_POST['idOeuvre']);
    $idClient = $_SESSION['idUser'];
    // Recherche si un commande avec statutCommande = 0 existe.
    $requetteSQL = "SELECT `idCommande`, `idClient`, `statutsCommande`
    FROM `commandes`
    WHERE `idClient`= idClient AND `statutsCommande` = 0";
    $prepare = [['prep'=> ':idClient', 'variable' => $idClient]];
    $dataCommande = readCommande($requetteSQL, $prepare);
    if(empty($dataCommande)) {
      print_r($dataCommande);
      // Aucune nouvelle commande trouver
      // On crée la nouvelle commande
      $requetteSQL = "INSERT INTO `commandes`(`idClient`) VALUES (:idClient)";
      $newCommande = new CurDB($requetteSQL, $prepare);
      $newCommande->actionDB();
      $requetteSQL = "SELECT `idCommande`, `idClient`, `statutsCommande`
      FROM `commandes`
      WHERE `idClient`= idClient AND `statutsCommande` = 0";
      // On lit le nouvelle idCommande
      $dataCommande = readCommande($requetteSQL, $prepare);
      $idCommande = $dataCommande[0]['idCommande'];
    } else {
      $idCommande = $dataCommande[0]['idCommande'];
    }
    // Enregistre la commande dans détail.
    // On va chercher le prix de l'oeuvre dans la DB
    $requetteSQL = "SELECT `prixOeuvre`, `cool` FROM `oeuvres` WHERE `idOeuvre` = :idOeuvre";
    $prepare = [['prep'=> ':idOeuvre', 'variable' => $idOeuvre]];
  $prixOeuvre = readCommande($requetteSQL, $prepare);
  $prixOeuvre = $prixOeuvre[0]['prixOeuvre'] + $prixOeuvre[0]['cool'];
    //Requette d'enregistrement de l'oeuvre
    $requetteSQL = "INSERT INTO `detailCommande`( `idDevis`, `prixHT`, `idOeuvre`)
    VALUES (:idDevis,:prixHT, :idOeuvre)";
    $prepare = [['prep'=> ':idOeuvre', 'variable' => $idOeuvre],
                ['prep'=> ':idDevis', 'variable' => $idCommande],
                ['prep'=> ':prixHT', 'variable' => $prixOeuvre]];
    $Article = new CurDB($requetteSQL, $prepare);
    $Article->actionDB();
    header('location:../index.php?idNav='.$idNav.' & message=Vous avez ajouter une oeuvre à votre panier.');
  }
  else { header('location:../index.php?message=Erreur de traitement');}
 ?>
