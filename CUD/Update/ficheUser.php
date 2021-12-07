<?php
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = filter($_POST['idUser']);
    $nom = filter($_POST['nom']);
    $prenom = filter($_POST['prenom']);
    $login = filter($_POST['login']);
    $nom = filter($_POST['nom']);
    if(isset($_POST['valide']) && isset($_POST['role'])) {
      require '../../administration/securite.php';
      $valide = filter($_POST['valide']);
      $role = filter($_POST['role']);
      $requetteSQL = "UPDATE `users`
      SET `nom`= :nom,`prenom`= :prenom,`login`= :login,
      `valide`= :valide,`role`= :role
      WHERE `idUser`= :idUser";
      $parametreUser = [
        ['prep'=> ':idUser', 'variable' => $idUser],
        ['prep'=> ':nom', 'variable' => $nom],
        ['prep'=> ':prenom', 'variable' => $prenom],
        ['prep'=> ':login', 'variable' => $login],
        ['prep'=> ':valide', 'variable' => $valide],
        ['prep'=> ':role', 'variable' => $role]];
    } else {
      $requetteSQL = "UPDATE `users`
      SET `nom`= :nom,`prenom`= :prenom,`login`= :login
      WHERE `idUser`= :idUser";
      $parametreUser = [
        ['prep'=> ':idUser', 'variable' => $idUser],
        ['prep'=> ':nom', 'variable' => $nom],
        ['prep'=> ':prenom', 'variable' => $prenom],
        ['prep'=> ':login', 'variable' => $login]];
    }
    $updateUser = new CurDB($requetteSQL, $parametreUser);
    $updateUser->actionDB();
    header('location:../../index.php?message=Fiche de '.$login.' modifiée.');
  } else {
    header('location:../../index.php?message=Erreur de modification de la fiche.');
  }
 ?>
