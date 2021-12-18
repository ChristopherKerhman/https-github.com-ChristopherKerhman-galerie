<?php
$idOeuvre = filter($_GET['idOeuvre']);
$idNav = filter($_GET['idNav']);
require 'objets/monoOeuvre.php';
require 'objets/commentaires.php';
$readOeuvre = new monoOeuvre($idOeuvre);
$data = $readOeuvre->readOeuvre();
$readOeuvre->affichageOeuvre($data);
$readOeuvre->populaire($data);
$readOeuvre->commander($data);
$commentaires = new commentaires($idOeuvre, $idNav);
$dataCommentaire = $commentaires->readCommentaires();
$commentaires->redigerCommentaire();
$commentaires->affichageCommentaire($dataCommentaire);
