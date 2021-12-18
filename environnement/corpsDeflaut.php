<article id="texte">
<p>
Nous proposons à l’exposition mais aussi à la vente des œuvres d’arts de divers origines, toutes numériques, avec de la fausse monnais. <br />
Ici, rien ne vous sera demander, vu que c'est un projet pour travailler divers sujet de développement et notamment la POO.<br /><br />
Vagabonder dans les méandres de la galerie, tel un lézard numérique, pour découvrir des œuvres qui sauront sans doute vous ouvrir les volets de la perception
et laisser voyager votre esprit dans les univers créés du binaires que sont les arts numériques.
<br /><br />
<strong>Vous découvrirez plus d'oeuvre et de fonctionnalité en créant un compte sur ce site.</strong>
</p>
</article>
<article>
  <?php // trie des 6 dernière oeuvre intégrer à la DB
  $requetteSQL = "SELECT `idOeuvre`, `nomOeuvre`, `nomFichier`, `prixOeuvre`, `createurOeuvre`, `cool`, `Speudo` FROM `oeuvres`
INNER JOIN `artistes` ON `createurOeuvre` = `idArtiste`
ORDER BY `idOeuvre` DESC LIMIT 4";
$prepare = [];
$galerie = new readDB($requetteSQL, $prepare);
$data6O = $galerie->read();
require 'objets/oeuvre.php';
   ?>
  <h3>Les nouvelles oeuvres de la Galerie</h3>
  <div class="gallery">
    <?php
    foreach ($data6O as $key) {
      $oeuvreUnique = new oeuvre ($key, $idNav);
      $oeuvreUnique->affichageVisiteur();

    }

     ?>
</div>
</article>
