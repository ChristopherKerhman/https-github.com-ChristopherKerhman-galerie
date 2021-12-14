<article id="texte">
  <h3>Lézard Numérique</h3>
<p>
Ce site est une galerie d’art numérique. Nous proposons à l’exposition mais aussi à la vente des œuvres d’arts de divers origines, toutes numériques.<br /><br />
Vagabonder dans les méandres de la galerie, tel un lézard numérique, pour découvrir des œuvres qui seront sans doute vous ouvrir les volets de la perception et laisser voyager votre esprit dans les univers créer du binaires que son les arts numériques.
</p>
</article>
<article>
  <?php // trie des 6 dernière oeuvre intégrer à la DB
  $requetteSQL = "SELECT `idOeuvre`, `nomOeuvre`, `nomFichier`, `prixOeuvre`, `createurOeuvre`, `cool`, `Speudo` FROM `oeuvres`
INNER JOIN `artistes` ON `createurOeuvre` = `idArtiste`
ORDER BY `idOeuvre` DESC LIMIT 6";
$prepare = [];
$galerie = new readDB($requetteSQL, $prepare);
$data6O = $galerie->read();
require 'objets/oeuvre.php';
   ?>
  <h3>Les dernières oeuvres de la Galerie</h3>
  <div class="gallery">
    <?php
    foreach ($data6O as $key) {
      $oeuvreUnique = new oeuvre ($key, $idNav);
      $oeuvreUnique->affichageVisiteur();

    }

     ?>
</div>
</article>
