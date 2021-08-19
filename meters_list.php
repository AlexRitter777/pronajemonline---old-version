<?php // список служеб из массива в services.php
  require "includes/services.php";
  $metersCount = count($meters);
  $i = 0;
  while ($i < $metersCount)
  {
      echo("<option value =" . $i . ">" . $meters[$i] . "</option>");
      $i++;
  }
?>