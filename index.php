<?php include 'environnement/header.php' ?>
      <?php if(isset($_GET['message'])){ echo '<h3>'.filter($_GET['message']).'</h3>'; } ?>
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
            $idNav = $dataAffichage[0]['cheminNav'];
         }
          ?>
<?php include 'environnement/footer.php' ?>
