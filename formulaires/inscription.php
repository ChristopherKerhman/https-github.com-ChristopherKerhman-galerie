<form class="formulaire" action="CUD/Create/inscription.php" method="post">
    <div class="colonne boxStandard">
      <h3>Formulaire d'inscription</h3>
      <h4>Votre identité</h4>
      <label for="nom">Nom</label>
      <input id="nom" class="inputFormulaire" type="text" name="nom" required>
      <label for="prenom">Prenom</label>
      <input id="prenom" class="inputFormulaire" type="text" name="prenom" required>
      <label for="login">Login</label>
      <input id="login" class="inputFormulaire" type="text" name="login" required>
      <label for="mdp">Mot de passe</label>
      <input id="mdp" class="inputFormulaire" type="text" name="mdp" required>
    <button class="buttonStandard" type="submit" name="button">Créer un compte</button>
    </div>
</form>
