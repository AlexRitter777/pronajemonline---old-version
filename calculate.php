<?php

require "includes/services.php"; //подключаем файл с видами расходов и счетчиков

//переменные, заданные из формуляра

$landlordName = $_POST['landlordName'];
$landlordAddress = $_POST['landlordAddress'];

$propertyAddress = $_POST['propertyAddress'];
$propertyType = $_POST['propertyType'];

$tenantName = $_POST['tenantName'];
$tenantAddress = $_POST['tenantAddress'];

$calcStartDate = $_POST['calcStartDate'];
$calcFinishDate = $_POST['calcFinishDate'];
$rentStartDate = $_POST['rentStartDate'];
$rentFinishDate = $_POST['rentFinishDate'];

$pausalniNaklad = $_POST['pausalniNaklad']; //индексы названия служеб
$servicesCost = $_POST['servicesCost']; // расходы на службы

$appMeters = $_POST['appMeters'];
$initialValue = $_POST['initialValue'];
$endValue = $_POST['endValue'];

$constHotWaterPrice = $_POST['constHotWaterPrice'];
$constHeatingPrice = $_POST['constHeatingPrice'];
$hotWaterPrice = $_POST['hotWaterPrice'];
$coldWaterPrice = $_POST['coldWaterPrice'];
$heatingPrice = $_POST['heatingPrice'];
$gasPrice = $_POST['gasPrice'];
$advancedPayments = $_POST['advancedPayments'];


/*-------------------------Шапка и исходные данные------------------*/

echo('<h2>Vyučtování služeb spojených s uživaním bytu za období ' . $rentStartDate. ' do ' . $rentFinishDate . '</h2>');
echo('<span><b>Pronajmetel:</b></span></br>');
echo(htmlspecialchars($landlordName));
echo ('<br/>');
echo(htmlspecialchars($landlordAddress));
echo ('<br/>');
echo ('<br/>');
echo('<span><b>Objekt najmu:</b></span></br>');
echo(htmlspecialchars($propertyAddress));
echo ('<br/>');
echo(htmlspecialchars($propertyType));
echo ('<br/>');
echo ('<br/>');
echo('<span><b>Nájemnik:</b></span></br>');
echo(htmlspecialchars($tenantName));
echo ('<br/>');
echo(htmlspecialchars($tenantAddress));
echo ('<br/>');
echo ('<br/>');

//---Период выучтования справце 
$calcStartDateSec = strtotime($calcStartDate);
$calcFinishDateSec = strtotime($calcFinishDate);
$totalCalcSecondsDiff = abs($calcFinishDateSec-$calcStartDateSec);
$totalCalcMonthsDiff = $totalCalcSecondsDiff / (60*60*24*30);
$totalCalcMonthsDiffRound = round($totalCalcMonthsDiff,1);
echo('<span><b>Na základě vyučtování spravce za období:</b></span></br>');
echo($calcStartDate . ' do ' . $calcFinishDate . ' - ' . $totalCalcMonthsDiffRound . ' měs.');
echo ('<br/>');
echo ('<br/>');

//---Период выучтования для арендатора
$rentStartDateSec = strtotime($rentStartDate);
$rentFinishDateSec = strtotime($rentFinishDate);
$totalSecondsDiff = abs($rentFinishDateSec-$rentStartDateSec);
$totalMonthsDiff = $totalSecondsDiff / (60*60*24*30);
$totalMonthsDiffRound = round($totalMonthsDiff,1);
echo('<span><b>Období vyučtování:</b></span></br>');
echo($rentStartDate . ' do ' . $rentFinishDate . ' - ' . $totalMonthsDiffRound . ' měs.');
echo ('<br/>');
echo ('<br/>');

/*----------------------------Расчет-------------------------------*/

//Показание счетчиков и расчет потреблений

echo('<span><b>Odečty meříčů:</b></span></br>');

$j=0;
foreach($appMeters as $meter){
  echo('<b>' . $meters[$meter].':</b> </br>Stav 1: '.$initialValue[$j].' </br>Stav 2: '.$endValue[$j] . '</br>Spotřeba: ' . ($endValue[$j]-$initialValue[$j]));
  $j++;
  echo ('<br/>');
}
echo ('<br/>');

$coefficientValue = $_POST['coefficientValue'];
echo('<span><b>Použité koeficienty pro UT:</b></span></br>');
$z = 1;
foreach($coefficientValue as $coefficientV){
  echo('K' . $z . ' = ' . $coefficientV . '</br>');
  $z++;
}
echo('</br>');

if (isset($_POST['coefficientValue'])){
  $coefficientFinal = array_product($coefficientValue);
}

$x=0; 
foreach($appMeters as $meter){
  if ($meter == 0){
    $totalTuvValue = $totalTuvValue + ($endValue[$x] - $initialValue[$x]);
  }
  elseif ($meter == 1){
    $totalSuvValue = $totalSuvValue + ($endValue[$x] - $initialValue[$x]);
  }
  elseif ($meter == 2) {
    $totalUtValue = $totalUtValue + ($endValue[$x] - $initialValue[$x]);
  } 
$x++;
}

if (isset($_POST['coefficientValue'])){
  $coefficientFinal = array_product($coefficientValue);
  $totalUtValueKoef = $totalUtValue * $coefficientFinal;
  
}
else {
  $totalUtValueKoef = $totalUtValue;
}

echo('<span><b>Celkové spotřeby:</b></span></br>');
echo('Total TUV Value = ' . $totalTuvValue . '</br>');
echo('Total SUV Value = ' . $totalSuvValue . '</br>');
echo('Total UT Value = ' . $totalUtValue . '</br>');
echo('Total UT Value incl. K =' . $totalUtValueKoef . '</br>');
echo('</br>');

//Цены на энергию
echo('<span><b>Ceny energií:</b></span></br>');
echo('Cena TUV - '. $hotWaterPrice . '</br>');
echo('Cena SUV - ' . $coldWaterPrice . '</br>');
echo('Cena UT - ' . $heatingPrice . '</br>');
echo('<br/>');

// Паушальные расходы 
echo('<span><b>Paušalní náklady:</b></span></br>');

$i=0;
foreach($pausalniNaklad as $naklad){
  echo($services[$naklad].': '.$servicesCost[$i]);
  $i++;
  echo ('<br/>');
}

$pausalniNaklady = array_sum($servicesCost);
echo ('Součet paušalních nakladů: '. $pausalniNaklady);
echo ('<br/>');

$MesicPausalniNaklady = $pausalniNaklady / $totalCalcMonthsDiffRound;
$MesicPausalniNakladyRound = round($MesicPausalniNaklady,2);
echo ('<span><b>Paušalní náklady za 1 měs:</b></span> '. $MesicPausalniNakladyRound . '</br>');
echo ('<br/>');

//Закладни сложки
echo('<span><b>Základní složky:</b></span></br>');

$constHotAndHeating = $constHotWaterPrice + $constHeatingPrice;
$constMonthHotAndHeating = $constHotAndHeating / $totalCalcMonthsDiffRound;
$constMonthHotAndHeatingRound = round($constMonthHotAndHeating, 2);
echo('Zakladní složka TUV ' . $constHotWaterPrice . '</br>');
echo('Zakladní složka UT ' . $constHeatingPrice . '</br>');
echo('Zakladní složky celkem: ' . $constHotAndHeating . '</br>');
echo('<span><b>Základní složky za 1 měs</b><span>: ' . $constMonthHotAndHeatingRound . '</br>');
echo ('<br/>');

//Потребленные сложки
$totalHotWaterPrice = $hotWaterPrice * $totalTuvValue;
$totalHotWaterPriceRound = round($totalHotWaterPrice, 2);

$totalColdWaterPrice = $coldWaterPrice * $totalSuvValue;
$totalColdWaterPriceRound = round($totalColdWaterPrice, 2);

$totalColdForHotWaterPrice = $coldWaterPrice * $totalTuvValue;
$totalColdForHotWaterPriceRound = round($totalColdForHotWaterPrice, 2);

$totalHeatingPrice = $heatingPrice * $totalUtValueKoef;
$totalHeatingPriceRound = round($totalHeatingPrice, 2);

$totalUtilitesPrices = $totalHotWaterPriceRound + $totalColdWaterPriceRound + $totalColdForHotWaterPriceRound + $totalHeatingPriceRound;
$totalMonthUtilitesPrices = $totalUtilitesPrices / $totalMonthsDiffRound;
$totalMonthUtilitesPricesRound = round($totalMonthUtilitesPrices, 2);

echo('<span><b>Spotřební složky:</b></span></br>');
echo ('Spotřební složka TUV: ' . $totalHotWaterPriceRound . '</br>');
echo ('Spotřební složka SUV: ' . $totalColdWaterPriceRound . '</br>');
echo ('Spotřební složka SUV pro TUV: ' . $totalColdForHotWaterPriceRound . '</br>');
echo ('Spotřební složka UT: ' . $totalHeatingPriceRound . '</br>');
echo ('Celkem spotřební složky: ' . $totalUtilitesPrices . '</br>');
echo ('<b>Celkem spotřební složky za 1 měs:</b> ' . $totalMonthUtilitesPricesRound . '</br>');
echo ('<br/>');

//Итоговый расчет
echo('<span><b>Vyučtování:</b></span></br>');
$totalMonthCost = $MesicPausalniNakladyRound + $constMonthHotAndHeatingRound + $totalMonthUtilitesPricesRound;
echo('Celkem náklady za 1 měs: ' . $totalMonthCost . '</br>');
$totalCost = $totalMonthCost * $totalMonthsDiffRound;
$totalCostRound = round($totalCost, 2);
echo('Celkem náklady za období: ' . $totalCostRound . '</br>');
echo ('<br/>');
echo('Úhrazené zálohy za období: ' .  $advancedPayments . '</br>');
echo ('<br/>');
$finalDiff = $advancedPayments - $totalCostRound;
if ($finalDiff < 0)
  echo ('<b>Nedoplatek:</b> ' . abs($finalDiff));
else
  echo ('<b>Preplatek:</b>' . $finalDiff);  


echo ('<br/>');
echo ('<br/>');
echo ('<br/>');
echo ('<br/>');
echo('<p><i>Rentmanage software 2021</i><p>');
echo ('<br/>');
echo(date('d.m.Y'));

?>