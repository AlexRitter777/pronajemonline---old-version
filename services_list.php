<?php // список служеб из массива в services.php
  require "includes/services.php";
  $servicesCount = count($services);
  $i = 1;
  while ($i < $servicesCount)
  {
      echo("'<option value =" . $i . ">" . $services[$i] . "</option>'+");
      $i++;
  }
?>