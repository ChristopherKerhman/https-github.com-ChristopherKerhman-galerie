<?php // trie des 6 dernière oeuvre intégrer à la DB
$requetteSQL = "SELECT `idOeuvre`, `nomOeuvre`, `nomFichier`, `prixOeuvre`, `createurOeuvre`, `cool`, `Speudo` FROM `oeuvres`
INNER JOIN `artistes` ON `createurOeuvre` = `idArtiste`
ORDER BY `createurOeuvre`";
$prepare = [];
$galerie = new readDB($requetteSQL, $prepare);
$dataGallerie = $galerie->read();
require 'objets/oeuvre.php';
 ?>
 <section class="sectionGallery">
<h3>Les oeuvres de nos artistes</h3>
<div class="gallery">
    <?php
       foreach ($dataGallerie as $key) {
         $oeuvreUnique = new oeuvre ($key, $idNav);
         $oeuvreUnique->affichageGallery();
         $oeuvreUnique->navigation();
         echo'</li></ul>
                  </figcaption>
              </figure>
              </div>';
       }

     ?>
</div>
</section>
