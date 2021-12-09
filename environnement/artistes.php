<?php
$requetteSQL = "SELECT `idArtiste`, `nomArtiste`, `prenomArtiste`, `Speudo`, `photoIdentiter`, `biographie`
FROM `artistes` WHERE `valide` = 1 ORDER BY `Speudo` ASC";
$prepare = [];
$readArtiste = new readDB($requetteSQL, $prepare);
$dataArtiste = $readArtiste->read();
 ?>
<h3>Nos artistes</h3>
<?php
foreach ($dataArtiste as $key) {
  echo '
  <ul class="boxStandard">
  <li><img src="photoArtiste/'.$key['photoIdentiter'].'" alt="Photo de '.$key['Speudo'].'" width="100em"></li>
  <li class="ligne"><strong>Speudo :</strong>&nbsp;<h4>'.$key['Speudo'].'</h4></li>
  <li><strong>Prenom :</strong> '.$key['prenomArtiste'].'</li>
  <li><strong>Nom :</strong> '.$key['nomArtiste'].'</li>
  <li><h4>A propos de '.$key['Speudo'].'</h4><p> '.$key['biographie'].'</p></li>
  </ul>';
}
 ?>
