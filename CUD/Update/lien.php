<?php
session_start();
if ($_SESSION['role'] != 3) {
  header('location:https://www.google.com/');
} else {
  require '../../objets/paramDB.php';
  require '../../objets/cud.php';
  require '../../objets/readDB.php';
  include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $nomLien = filter($_POST['nomLien']);
  $cheminNav = filter($_POST['cheminNav']);
  $valide = filter($_POST['valide']);
  $levelAdmi = filter($_POST['levelAdmi']);
  $ordre = filter($_POST['ordre']);
  $requetteSQL = "UPDATE `nav`
  SET
  `nomLien`= :nomLien,
  `cheminNav`=:cheminNav,
  `valide`= :valide,
  `levelAdmi`= :levelAdmi,
  `ordre`= :ordre
  WHERE `idNav` = :idNav";
    $prepare = [
      ['prep'=> ':idNav', 'variable' => $idNav],
      ['prep'=> ':nomLien', 'variable' => $nomLien],
      ['prep'=> ':cheminNav', 'variable' => $cheminNav],
      ['prep'=> ':valide', 'variable' => $valide],
      ['prep'=> ':levelAdmi', 'variable' => $levelAdmi],
      ['prep'=> ':ordre', 'variable' => $ordre],
  ];
  $updateLien = new CurDB($requetteSQL, $prepare);
  $updateLien->actionDB();
  header('location:../../index.php?message=Menu '.$nomLien.' modifié');
  } else {
  header('location:../../index.php?message=Erreur');
  }
}
