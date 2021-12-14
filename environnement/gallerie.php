
<article>
<?php // trie des 6 dernière oeuvre intégrer à la DB
$requetteSQL = "SELECT `idOeuvre`, `nomOeuvre`, `nomFichier`, `prixOeuvre`, `createurOeuvre`, `cool`, `Speudo` FROM `oeuvres`
INNER JOIN `artistes` ON `createurOeuvre` = `idArtiste`
ORDER BY `createurOeuvre`";
$prepare = [];
$galerie = new readDB($requetteSQL, $prepare);
$dataGallerie = $galerie->read();
require 'objets/oeuvre.php';
 ?>
 <section>
<article class="tailleGallerie">
<h3>Gallerie de nos oeuvres</h3>
<div class="gallery">
    <?php
       foreach ($dataGallerie as $key) {
         $oeuvreUnique = new oeuvre ($key, $idNav);
         $oeuvreUnique->affichageGallery();

       }

     ?>
</div>
</article>
