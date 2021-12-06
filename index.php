<?php include 'environnement/header.php' ?>
    <section>
      <?php if(isset($_GET['message'])){ echo '<h4>'.filter($_GET['message']).'</h4>'; } ?>
      <article>
        <?php
        if (isset($_GET['idNav'])) {
          $idNav = filter($_GET['idNav']);
          $requetteSQL = "SELECT  `cheminNav`
          FROM `nav` WHERE `idNav` = :idNav";
          $prepare = [['prep'=> ':idNav', 'variable' => $idNav]];
          $affichage = new readDB($requetteSQL, $prepare);
          $dataAffichage = $affichage->read();
        }
         ?>
         <?php
         if (empty($dataAffichage)) {
            include 'environnement/corpsDeflaut.php';
         } else {
            include $dataAffichage[0]['cheminNav'];
         }
          ?>
      </article>
    </section>
<?php include 'environnement/footer.php' ?>
