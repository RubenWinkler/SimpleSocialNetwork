<?php

// Sortiert Arrays aus der Datenbank nach dem Timestamp
function sortFunction( $a, $b ) {
  return strtotime($a["time"]) - strtotime($b["time"]);
}

 ?>
