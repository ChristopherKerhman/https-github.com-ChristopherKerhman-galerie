<?php
include 'administration/securite.php';
$role = ['Non valide', 'utilisateur', 'gestionnaire', 'administrateur'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`
FROM `users`
ORDER BY `login` ASC";
$prepare = [];
$readUser = new readDB ($requetteSQL, $prepare);
$dataUser = $readUser->read()
 ?>
<h3>Administration des utilisateurs</h3>
<article class="">
  <ul>
    <?php
  foreach ($dataUser as $key) {
    echo '<li class="ligne"><a class="lienAdmin" href="Page-ficheUser.php?idUser='.$key['idUser'].'">'.$key['login'].' - Rôle : '.$role[$key['role']].'</a></li>';
  }
     ?>
  </ul>
  </article>
