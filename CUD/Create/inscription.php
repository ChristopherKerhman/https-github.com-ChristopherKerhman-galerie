<?php
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom = filter($_POST['nom']);
  $prenom = filter($_POST['prenom']);
  $login = filter($_POST['login']);
  $requetteSQL = "SELECT `login` FROM `users` WHERE `login` = :login";
  $prepare = [['prep'=> ':login', 'variable' => $login],];
  $controle = new readDB($requetteSQL, $prepare);
  $doublon = $controle->read();
  if (empty($doublon[0]['login'])) {
    $moria = filter($_POST['mdp']);
    $mdp = haschage($moria);
    $requetteSQL = "INSERT INTO `users`(`nom`, `prenom`, `login`, `mdp`)
    VALUES (:nom, :prenom, :login, :mdp)";
      $prepare = [['prep'=> ':nom', 'variable' => $nom],
        ['prep'=> ':prenom', 'variable' => $prenom],
        ['prep'=> ':login', 'variable' => $login],
        ['prep'=> ':mdp', 'variable' => $mdp]];
        $dataUser = new CurDB($requetteSQL, $prepare);
        $dataUser->actionDB();
      header('location:../../index.php?message=Nouvelle inscription validée');
  } else {
  header('location:../../index.php?message=Login déjà utilisé.');
  }
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}


 ?>
