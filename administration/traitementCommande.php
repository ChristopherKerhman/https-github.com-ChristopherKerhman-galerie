<?php
$requetteSQL = "SELECT `idCommande`, `idClient`, `statutsCommande`, `nom`, `prenom` FROM `commandes`
INNER JOIN `users` ON `idClient` = `idUser`
WHERE `statutsCommande` >= 2 AND `statutsCommande` <=4";
$prepare = [];
$readCommande = new readDB($requetteSQL, $prepare);
$dataCommande = $readCommande->read();
print_r($dataCommande);
 ?>
