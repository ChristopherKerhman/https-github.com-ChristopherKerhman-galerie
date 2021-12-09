<?php include 'securite/securiterCreateur.php'; ?>
<form class="formulaire" action="CUD/Create/artiste.php" method="post" enctype="multipart/form-data">
    <div class="colonne boxStandard">
    <h3>Ajouter un artiste</h3>
      <h4>Son identité</h4>
      <label for="nom">Nom</label>
      <input id="nom" class="inputFormulaire" type="text" name="nomArtiste">
      <label for="prenom">Prenom</label>
      <input id="prenom" class="inputFormulaire" type="text" name="prenomArtiste">
      <label for="login">Speudo</label>
      <input id="login" class="inputFormulaire" type="text" name="speudo">
      <label for="bio">A propos de cette artiste :</label>
      <textarea id="bio" name="biographie" rows="8" cols="80">Quelques mots sur l'artiste.</textarea>
      <label for="valide">Valider immédiatement la fiche ?</label>
      <select id="valide" class="inputFormulaire" name="valide">
        <option value="0"selected>Non valide</option>
        <option value="1">Valide</option>
      </select>
      <label for="avatar">Une photo de l'artiste</label>
      <input type="file" id="avatar" class="buttonAdmin" name="photoIdentiter" accept="image/png, image/jpeg">
    <button class="buttonAdmin" type="submit" name="button">Créer la fiche de l'artiste</button>
    </div>
</form>
