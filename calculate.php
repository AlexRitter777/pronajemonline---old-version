<?php

require "includes/services.php";

$pausalniNaklad = $_POST['pausalniNaklad']; //названия служеб
$servicesCost = $_POST['servicesCost']; // расходы на службы


echo array_sum($servicesCost); // сумма расходов
echo ('<br/>');

foreach($pausalniNaklad as $tempNaklad) { // список расходов
  echo ($services[$tempNaklad].'<br/>');
}



?>