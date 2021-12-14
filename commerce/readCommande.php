<?php
function readCommande ($SQL, $data) {
  $read = new readDB($SQL, $data);
  return $read->read();
}
?>
