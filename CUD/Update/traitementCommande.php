<?php
session_start();
include '../../securite/securiterCreateur.php';
require '../../objets/paramDB.php';
require '../../objets/cud.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idCommande = filter($_POST['idCommande']);
  $statuts = filter($_POST['statutsCommande']);
  $idNav = filter($_POST['idNav']);
  $SQL = "UPDATE `commandes` SET `statutsCommande`= :statutsCommande WHERE `idCommande` = :idCommande";
  $pre = [['prep'=> ':idCommande', 'variable' => $idCommande],
          ['prep'=> ':statutsCommande', 'variable' =>$statuts]];
  $payerCommande = new CurDB($SQL, $pre);
  $payerCommande->actionDB();
  header('location:../../index.php?idNav='.$idNav.' & message=Commande n° GLN '.$idCommande.' modifié.');
  } else {
    header('location:../../index.php?message=Erreur de traitement');
  }
 ?>
