<?php
session_start();
include '../CUD/fonctionsDB.php';
require '../objets/paramDB.php';
require '../objets/cud.php';
require '../objets/readDB.php';
include 'statuts.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idOeuvre = filter($_POST['idOeuvre']);
    $idClient = $_SESSION['idUser'];
    // Recherche si un commande avec statutCommande = 0 existe.
    $requetteSQL = "SELECT `idCommande`, `idClient`, `statutsCommande`
    FROM `commandes`
    WHERE `idClient`= idClient AND `statutsCommande` = 0";
    $prepare = [['prep'=> ':idClient', 'variable' => $idClient]];
    $searchCommande = new readDB($requetteSQL, $prepare);
    $dataCommande =   $searchCommande->read();
    print_r($dataCommande);
    if(empty($dataCommande)) {
      // Aucune nouvelle commande trouver
      // On crée donc la nouvelle commande
      /*$requetteSQL = "INSERT INTO `commandes`(`idClient`) VALUES (:idClient)";
      $newCommande = new CurDB($requetteSQL, $prepare);
      $newCommande->actionDB();*/

    } else {
      echo 'Ya quest chose dedans';
    }
    //header('location:../index.php?idNav='.$idNav.' & message=Vous avez ajouter une oeuvre à votre panier.');
  }
  else { header('location:../index.php?message=Erreur de traitement');}
 ?>
