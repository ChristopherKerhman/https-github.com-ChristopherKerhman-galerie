<?php
$requetteSQL = "SELECT `idArtiste`,`Speudo`
FROM `artistes` WHERE `valide` = 1";
$prepare = [];
$readArtiste = new readDB($requetteSQL, $prepare);
$dataArtiste = $readArtiste->read();
 ?>
<h3>Ajouter une nouvelle oeuvre à la galerie</h3>
<form class="colonne boxStandard" action="CUD/Create/oeuvre.php" method="post" enctype="multipart/form-data">
  <label for="nom">Nom de l'oeuvre</label>
  <input id="nom" class="inputFormulaire" type="text" name="nomOeuvre" >
  <label for="description">Intention de l'artiste sur cette oeuvre</label>
<textarea id="description" class="inputFormulaire" name="description" rows="16" cols="20"></textarea>
<div class="ligne">
  <label for="prix">Prix de vente Hors Taxe</label>
  <input type="number" name="prixOeuvre" min="0" max="100000" value="100"> € HT
</div>
<label for="avatar">Oeuvre format Web</label>
<input type="file" id="avatar" class="buttonAdmin" name="nomFichier" accept="image/png, image/jpeg">
<select class="inputFormulaire" name="createurOeuvre">
  <?php
    foreach ($dataArtiste as $key) {
      echo '<option value="'.$key['idArtiste'].'">'.$key['Speudo'].'</option>';
    }
   ?>
 </select>
<div class="ligne">
  <button class="buttonAdmin" type="submit"  name="button">Enregistrer</button>
  <button class="buttonAdmin" type="reset" name="button">Remise à 0</button>

</div>

</form>
