<?php
$idOeuvre = filter($_GET['idOeuvre']);
$idNav = filter($_GET['idNav']);
require 'objets/monoOeuvre.php';
$readOeuvre = new monoOeuvre($idOeuvre);
$data = $readOeuvre->readOeuvre();
$readOeuvre->affichageOeuvre($data);
$readOeuvre->populaire($data);
$readOeuvre->commander($data);
 ?>
