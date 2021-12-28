<?php

require_once "includes/services.php"; //подключаем файл с видами расходов и счетчиков
require_once "validation.php"; //подключаем файл с валидацией 
require_once "autoloader.php";
require_once "functions.php";
session_start();

if (!$data['success']) {
  header('Location: index.php'); //если ошибки есть => пользователь не отправил форму, т.е. не прошел валидацией => направляем на главную
  die();
} else {  //если прошел валидацией и формой, то выполняем программу


  //---переменные, заданные из формуляра

  $landlordName = $_POST['landlordName']; //имя арендодателя    
  $landlordAddress = $_POST['landlordAddress']; // адрес арендодателя 
  $accountNumber = $_POST['accountNumber']; //номер счета арендодателя

  $propertyAddress = $_POST['propertyAddress']; // адрес объекта недвижимости
  $propertyType = $_POST['propertyType']; // тип недвижимости

  $tenantName = $_POST['tenantName']; //имя арендатора
  $tenantAddress = $_POST['tenantAddress']; //адрес арендатора

  $adminName = $_POST['adminName']; // наименование управл. компании

  $calcStartDate = $_POST['calcStartDate']; //начальная дата выучтования справце
  $calcFinishDate = $_POST['calcFinishDate']; //конечная дата выучтования справце
  $rentStartDate = $_POST['rentStartDate']; //начальная дата периода выучтования для арендатора 
  $rentFinishDate = $_POST['rentFinishDate']; //конечная дата периода выучтования для арендатора 

  $pausalniNaklad = $_POST['pausalniNaklad']; //индексы названия служеб -> services.php -> $services
  $servicesCost = $_POST['servicesCost']; // расходы на службы

  $appMeters = $_POST['appMeters']; // индексы типов счетчиков -> services.php -> $meters
  $initialValue = $_POST['initialValue']; //начальные значения счетчиков для каждой строки
  $meterNumber = $_POST['meterNumber']; //серийные номера счетчиков
  $endValue = $_POST['endValue']; // конечные значения счетчиков для каждой строки
  $originMeterStart = $_POST['originMeterStart']; // откуда взяты начальные показания счетчиков
  $originMeterEnd = $_POST['originMeterEnd']; // откуда взяты конечные показания счетчиков
  $coefficientValue = $_POST['coefficientValue']; // значения коэффициентов, если они есть

  $constHotWaterPrice = $_POST['constHotWaterPrice']; // закладни сложка гор. воды
  $constHeatingPrice = $_POST['constHeatingPrice']; // закладни сложка хол. воды
  $hotWaterPrice = $_POST['hotWaterPrice']; // цена за 1м3 гор. воды
  $coldWaterPrice = $_POST['coldWaterPrice']; //цена за 1м3 хол. воды
  $coldForHotWaterPrice = $_POST['coldForHotWaterPrice']; //цена за 1м3 хол. воды на приготовление гор. воды
  $heatingPrice = $_POST['heatingPrice']; //цена за единцы отпления   
  $advancedPayments = $_POST['advancedPayments']; //сумма всех залог, оплаченных арендатором, за период выучтования

  //---Период выучтования справце
  $twoCalcDatesMonthDiff = new twoDatesMonthDiff($calcStartDate, $calcFinishDate);

  $calcMonthsDiff = $twoCalcDatesMonthDiff->twoDatesMonthDiff();

  //---Период выучтования для арендатора
  $twoRentDatesMonthDiff = new twoDatesMonthDiff($rentStartDate, $rentFinishDate);

  $rentMonthsDiff = $twoRentDatesMonthDiff->twoDatesMonthDiff();


  //---Объект для отображения значений в столбцах
  $runningValues = new RunnigValues();

  //---Проверка наличия коэффициентов отопления и их произведение
  if (isset($_POST['coefficientValue'])) {
    $coefficientFinal = round(array_product($coefficientValue), 3);
  }


  //---Расчет итоговых потреблений энергоносителей      
  for ($i = 0; $i < count($appMeters); $i++) {
    if (preg_match('/TUV/', $appMeters[$i])) {
      $totalTuvValue = $totalTuvValue + ($endValue[$i] - $initialValue[$i]);
    } elseif (preg_match('/SUV/', $appMeters[$i])) {
      $totalSuvValue = $totalSuvValue + ($endValue[$i] - $initialValue[$i]);
    } elseif (preg_match('/UT/', $appMeters[$i])) {
      $totalUtValue = $totalUtValue + ($endValue[$i] - $initialValue[$i]);
    }
  }

  if (isset($_POST['coefficientValue'])) {
    $totalUtValueKoef = round(($totalUtValue * $coefficientFinal), 2);
  } else {
    $totalUtValueKoef = $totalUtValue;
  }

  //---Паушальные расходы сумма за период и за месяц    
  $pausalniNaklady = array_sum($servicesCost);
  $MesicPausalniNaklady = $pausalniNaklady / $calcMonthsDiff;
  $MesicPausalniNakladyRound = round($MesicPausalniNaklady, 2);
  $pausalniNakladyCelkem = $MesicPausalniNakladyRound * $rentMonthsDiff;


  //---Закладни сложки
  $constHotAndHeating = $constHotWaterPrice + $constHeatingPrice;
  $constMonthHeatingPriceRound = round(($constHeatingPrice / $calcMonthsDiff), 2);
  $constMonthHotWaterPriceRound = round(($constHotWaterPrice / $calcMonthsDiff), 2);
  $constMonthHotAndHeatingRound = round(($constHotAndHeating / $calcMonthsDiff), 2);
  $constHotAndHeatingTotal = $constMonthHotAndHeatingRound * $rentMonthsDiff;

  //---Потребленные сложки
  $totalHotWaterPrice = $hotWaterPrice * $totalTuvValue;
  $totalHotWaterPriceRound = round($totalHotWaterPrice, 2);

  $totalColdWaterPrice = $coldWaterPrice * $totalSuvValue;
  $totalColdWaterPriceRound = round($totalColdWaterPrice, 2);

  $totalColdForHotWaterPrice = $coldWaterPrice * $totalTuvValue;
  $totalColdForHotWaterPriceRound = round($totalColdForHotWaterPrice, 2);

  $totalHeatingPrice = $heatingPrice * $totalUtValueKoef;
  $totalHeatingPriceRound = round($totalHeatingPrice, 2);

  $totalUtilitesPrices = $totalHotWaterPriceRound + $totalColdWaterPriceRound + $totalColdForHotWaterPriceRound + $totalHeatingPriceRound;
  $totalMonthUtilitesPrices = $totalUtilitesPrices / $rentMonthsDiff;
  $totalMonthUtilitesPricesRound = round($totalMonthUtilitesPrices, 2);


  //---Итоговый расчет 
  $totalMonthCost = $MesicPausalniNakladyRound + $constMonthHotAndHeatingRound + $totalMonthUtilitesPricesRound;
  $totalCost = $pausalniNakladyCelkem + $constHotAndHeatingTotal + $totalUtilitesPrices;
  $advancedPaymentsMonth = round(($advancedPayments / $rentMonthsDiff), 2);
  $finalDiff = $advancedPayments - $totalCost;
  if ($finalDiff < 0)
    $result = 'Nedoplatek';
  elseif ($finalDiff > 0)
    $result = 'Přeplatek';
  else
    $result = '';
}

//Сохраняем переменные в сессию

$_SESSION['landlordName'] = $landlordName; //имя арендодателя   
$_SESSION['landlordAddress'] = $landlordAddress; // адрес арендодателя 
$_SESSION['accountNumber'] = $accountNumber; //номер счета арендодателя
$_SESSION['propertyAddress'] = $propertyAddress; // адрес объекта недвижимости
$_SESSION['propertyType'] = $propertyType; // тип недвижимости
$_SESSION['tenantName'] = $tenantName; //имя арендатора
$_SESSION['tenantAddress'] = $tenantAddress; //адрес арендатора  
$_SESSION['adminName'] = $adminName; // наименование управл. компании
$_SESSION['calcStartDate'] = $calcStartDate; //начальная дата выучтования справце
$_SESSION['calcFinishDate'] = $calcFinishDate; //конечная дата выучтования справце
$_SESSION['rentStartDate'] = $rentStartDate; //начальная дата периода выучтования для арендатора 
$_SESSION['rentFinishDate'] = $rentFinishDate; //конечная дата периода выучтования для арендатора 
$_SESSION['pausalniNaklad'] = $pausalniNaklad; //перечень паушальных расходов для конкретного выучтования
$_SESSION['servicesCost'] = $servicesCost; // расходы на службы
$_SESSION['appMeters'] = $appMeters; // индексы типов счетчиков -> services.php -> $meters
$_SESSION['initialValue'] =  $initialValue; //начальные значения счетчиков для каждой строки
$_SESSION['endValue'] = $endValue; // конечные значения счетчиков для каждой строки
$_SESSION['meterNumber'] = $meterNumber; //серийные номера счетчиков
$_SESSION['originMeterStart'] = $originMeterStart; // откуда взяты начальные показания счетчиков
$_SESSION['originMeterEnd'] = $originMeterEnd; // откуда взяты конечные показания счетчиков
$_SESSION['coefficientValue'] = $coefficientValue; // значения коэффициентов, если они есть
$_SESSION['constHotWaterPrice'] = $constHotWaterPrice; // закладни сложка гор. воды
$_SESSION['constHeatingPrice'] = $constHeatingPrice;  // закладни сложка хол. отопления
$_SESSION['hotWaterPrice'] = $hotWaterPrice; // цена за 1м3 гор. воды
$_SESSION['coldWaterPrice'] = $coldWaterPrice; //цена за 1м3 хол. воды
$_SESSION['coldForHotWaterPrice'] = $coldForHotWaterPrice; //8цена за 1м3 хол. воды на приготовление гор. воды
$_SESSION['heatingPrice'] = $heatingPrice; //цена за единцы отпления  
$_SESSION['advancedPayments'] = $advancedPayments; //уплаченные залоги


?>

<!DOCTYPE html>
<html lang="cz">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/calc.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
  <title>Vyúčtování služeb</title>
</head>

<body>
  <div class="container">
    <div class="main-title">
      <h1 class="title">Vyúčtování služeb spojených s užíváním bytu za období<br>
        <? echo date("d.m.Y", strtotime($rentStartDate)) . ' - ' . date("d.m.Y", strtotime($rentFinishDate)) ?></h1>
    </div>
    <div class="personal">
      <div class="personal-left">
        <h3 class="sub-subtitle">Pronajímatel</h3>
        <span><? echo htmlspecialchars($landlordName) ?></span><br>
        <span><? echo htmlspecialchars($landlordAddress) ?></span><br>
      </div>
      <div class="personal-right">
        <h3 class="sub-subtitle">Nájemník</h3>
        <span><? echo htmlspecialchars($tenantName) ?></span><br>
        <span><? echo htmlspecialchars($tenantAddress) ?></span><br>
      </div>
    </div>
    <div class="property">
      <div class="property-left">
        <h3 class="sub-subtitle">Adresa nemovitosti:</h3>
        <span><? echo htmlspecialchars($propertyAddress) ?></span>
      </div>
      <div class="property-right">
        <h3 class="sub-subtitle">Druh nemovitosti:</h3>
        <span><? echo htmlspecialchars($propertyType) ?></span>
      </div>
    </div>
    <div class="admin">
      <div class="admin-text">
        <h3 class="sub-subtitle">Spravce domu:</h3>
        <span><? echo !empty($adminName) ? htmlspecialchars($propertyAddress) : 'Neuvedeno' ?></span>
      </div>
    </div>
    <div class="dates">
      <div class="dates-row-1">
        <div class="dates-row-title">Období vyúčtovaní</div>
        <div class="dates-row-date"><?php echo date("d.m.Y", strtotime($rentStartDate)) ?></div>
        <div class="dates-row-date"><?php echo date("d.m.Y", strtotime($rentFinishDate)) ?></div>
        <div class="dates-row-date"><?php echo $rentMonthsDiff . ' měs.' ?></div>
      </div>
      <div class="dates-row-2">
        <div class="dates-row-title">Období vyúčtovaní správce</div>
        <div class="dates-row-date"><?php echo date("d.m.Y", strtotime($calcStartDate)) ?></div>
        <div class="dates-row-date"><?php echo date("d.m.Y", strtotime($calcFinishDate)) ?></div>
        <div class="dates-row-date"><?php echo $calcMonthsDiff . ' měs.' ?></div>
      </div>
    </div>

    <h2 class="subtitle">I. Odečty měřících přístrojů</h2>
    <div class="meters">
      <div class="meters-header">
        <div class="col-1">
          <div class="row-1">Media</div>
        </div>
        <div class="col-2">
          <div class="row-1">Vyrobní číslo</div>
        </div>
        <div class="col-3">
          <div class="row-1">Počat. stav</div>
        </div>
        <div class="col-4">
          <div class="row-1">Koneč. stav</div>
        </div>
        <div class="col-5">
          <div class="row-1">Rozdíl náměr.</div>
        </div>
        <div class="col-6">
          <div class="row-1">Součin koeficientů</div>
        </div>
        <div class="col-7">
          <div class="row-1">Náměr pro vypočet</div>
        </div>
      </div>

      <div class="meters-section">
        <div class="col-1">
          <?php
          $runningValues->showSelectListString($appMeters);
          ?>
        </div>
        <div class="col-2">
          <?php
          $runningValues->showSelectListString($meterNumber);
          ?>
        </div>
        <div class="col-3">
          <?php
          $runningValues->showRowValues($initialValue);
          ?>
        </div>
        <div class="col-4">
          <?php
          $runningValues->showRowValues($endValue);
          ?>
        </div>
        <div class="col-5">
          <?php
          $runningValues->showDiffRowValues($initialValue, $endValue)
          ?>
        </div>
        <div class="col-6">
          <?php
          if (isset($_POST['coefficientValue'])) {
            $runningValues->showCoeficient($appMeters, $coefficientFinal);
          }
          ?>
        </div>
        <div class="col-7">
          <?php
          if (isset($_POST['coefficientValue'])) {
            $runningValues->showDiffInclCoeficientValues($initialValue, $endValue, $appMeters, $coefficientFinal);
          } else {
            $runningValues->showDiffRowValues($initialValue, $endValue);
          }
          ?>
        </div>
      </div>
      <div class="meters-section-origins">
        <div class="col-1">
          <div class="row-1">Zdroj odečtů počátečních stavů:</div>
          <div class="row-2">Zdroj odečtů konečných stavů:</div>
        </div>
        <div class="col-2">
          <div class="row-1">
            <? echo !empty($originMeterStart) ? $originMeterStart : 'Neuvedeno'; ?>
          </div>
          <div class="row-2">
            <? echo !empty($originMeterEnd) ? $originMeterEnd : 'Neuvedeno'; ?>
          </div>
        </div>
      </div>

      <div class="meters-footer">
        <div class="col-1">
          <div class="row-1">Souhrnné odečty</div>
          <div class="row-2">Teplá užitková voda (TUV)</div>
          <div class="row-3">Studená užitková voda (SUV)</div>
          <div class="row-4">Ústřední topení (UT)</div>
        </div>
        <div class="col-2">
          <div>&emsp;</div>
          <div>
            <? echo !empty($totalTuvValue) ? $totalTuvValue : "-"; ?>
          </div>
          <div>
            <? echo !empty($totalSuvValue) ? $totalSuvValue : "-"; ?>
          </div>
          <div>
            <? echo !empty($totalUtValueKoef) ? $totalUtValueKoef : "-"; ?>
          </div>
        </div>
      </div>
    </div>

    <h2 class="subtitle">II. Paušální náklady</h2>
    <div class="services-costs">
      <div class="services-costs-header">
        <div class="col-1">
          <div class="row-1">Pololožka</div>
        </div>
        <div class="col-2">
          <div class="row-1">Částka za období, Kč <br>(<? echo $calcMonthsDiff ?> měs)</div>
        </div>
        <div class="col-3">
          <div class="row-1">Částka za měsíc, Kč</div>
        </div>
      </div>
      <div class="services-costs-section">
        <div class="col-1">
          <?php
          $runningValues->showSelectListString($pausalniNaklad);
          ?>
        </div>
        <div class="col-2">
          <?php
          $runningValues->showRowValues($servicesCost);
          ?>
        </div>
        <div class="col-3">
          <?php
          $runningValues->showPeriodRowValues($servicesCost, $calcMonthsDiff);
          ?>
        </div>
      </div>
      <div class="services-costs-footer">
        <div class="col-1">
          <div class="row-1">Paušální náklady celkem</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $pausalniNaklady ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $MesicPausalniNakladyRound ?></div>
        </div>
      </div>
    </div>

    <h2 class="subtitle">III. Základní složky TUV a UT</h2>
    <div class="const-costs">
      <div class="info">
        Část nákladů na teplou užitkovou vodu a topení, nezávislé na spotřebě. Obvykle jsou závislé na ploše bytu a účtované pevnou částkou za rok
      </div>
      <div class="const-costs-header">
        <div class="col-1">
          <div class="row-1">Položka</div>
        </div>
        <div class="col-2">
          <div class="row-1">Částka za období, Kč <br>(<? echo $calcMonthsDiff ?> měs)</div>
        </div>
        <div class="col-3">
          <div class="row-1">Částka za měsíc, Kč</div>
        </div>
      </div>
      <div class="const-costs-section">
        <div class="col-1">
          <div class="row-1">Základní složka TUV</div>
          <div class="row-2">Základní složka UT</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $constHotWaterPrice ?></div>
          <div class="row-1"><? echo $constHeatingPrice ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $constMonthHotWaterPriceRound ?></div>
          <div class="row-1"><? echo $constMonthHeatingPriceRound ?></div>
        </div>
      </div>
      <div class="const-costs-footer">
        <div class="col-1">
          <div class="row-1">Základní složky celkem, Kč</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $constHotAndHeating ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $constMonthHotAndHeatingRound ?></div>
        </div>
      </div>
    </div>

    <h2 class="subtitle">IV. Spotřební složky TUV a UT</h2>
    <div class="var-costs">
      <div class="info">
        Část nákladů na teplou užitkovou vodu a topení stanovená na základě odečtů měřicích přístrojů
      </div>
      <div class="var-costs-header">
        <div class="col-1">
          <div class="row-1">Položka</div>
        </div>
        <div class="col-2">
          <div class="row-1">Naměr. pro vypočet</div>
        </div>
        <div class="col-3">
          <div class="row-1">Cena za jedn.,Kč</div>
        </div>
        <div class="col-4">
          <div class="row-1">Náklady, Kč</div>
        </div>
      </div>
      <div class="var-costs-section">
        <div class="col-1">
          <div class="row-1">Tepla užitková voda (TUV)</div>
          <div class="row-2">Studená užitková voda (SUV)</div>
          <div class="row-3">Studená užitková voda pro přípravu TUV (SUV)</div>
          <div class="row-4">Ústřední topení (ÚT)</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo !empty($totalTuvValue) ? $totalTuvValue : "-" ?></div>
          <div class="row-2"><? echo !empty($totalSuvValue) ? $totalSuvValue : "-" ?></div>
          <div class="row-3"><? echo !empty($totalTuvValue) ? $totalTuvValue : "-" ?></div>
          <div class="row-4"><? echo !empty($totalUtValueKoef) ?  $totalUtValueKoef : "-" ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $hotWaterPrice ?></div>
          <div class="row-2"><? echo $coldWaterPrice ?></div>
          <div class="row-3"><? echo $coldWaterPrice ?></div>
          <div class="row-4"><? echo $heatingPrice ?></div>
        </div>
        <div class="col-4">
          <div class="row-1"><? echo $totalHotWaterPriceRound ?></div>
          <div class="row-2"><? echo $totalColdWaterPriceRound ?></div>
          <div class="row-3"><? echo $totalColdForHotWaterPriceRound ?></div>
          <div class="row-4"><? echo $totalHeatingPriceRound ?></div>
        </div>
      </div>
      <div class="var-costs-footer-one">
        <div class="col-1">
          <div class="row-1"> Spotřební složky celkem, Kč</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $totalUtilitesPrices ?></div>
        </div>
      </div>
      <div class="var-costs-footer-two">
        <div class="col-1">
          <div class="row-1">Spotřební složky za 1 měsíc, Kč </div>
        </div>
        <div class="col-2">
          <div class="row-1">Náklady/období vyúčtování =</div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $totalUtilitesPrices ?> / <? echo $rentMonthsDiff ?> =</div>
        </div>
        <div class="col-4">
          <div class="row-1"><? echo $totalMonthUtilitesPricesRound ?></div>
        </div>
      </div>
    </div>

    <h2 class="subtitle">V. Vyúčtování</h2>
    <div class="calc">
      <div class="calc-header">
        <div class="col-1">
          <div class="row-1">Položka</div>
        </div>
        <div class="col-2">
          <div class="row-1">Částka za období, Kč <br>(<? echo $rentMonthsDiff ?> měs)</div>
        </div>
        <div class="col-3">
          <div class="row-1">Částka za měsíc, Kč</div>
        </div>
      </div>
      <div class="calc-section-one">
        <div class="col-1">
          <div class="row-1">Paušální náklady</div>
          <div class="row-2">Základní složky TUV, SUV, UT</div>
          <div class="row-3">Spotřební složky TUV, SUV, UT</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $pausalniNakladyCelkem ?></div>
          <div class="row-1"><? echo $constHotAndHeatingTotal ?></div>
          <div class="row-1"><? echo $totalUtilitesPrices ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $MesicPausalniNakladyRound ?></div>
          <div class="row-1"><? echo $constMonthHotAndHeatingRound ?></div>
          <div class="row-1"><? echo $totalMonthUtilitesPricesRound ?></div>
        </div>
      </div>
      <div class="calc-section-two">
        <div class="col-1">
          <div class="row-1">Náklady celkem, Kč</div>
          <div class="row-2">Součet uhrazených záloh</div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $totalCost ?></div>
          <div class="row-2"><? echo $advancedPayments ?> </div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $totalMonthCost ?></div>
          <div class="row-2"></div>
        </div>
      </div>
      <div class="calc-footer">
        <div class="col-1">
          <div class="row-1">Výsledek vyúčtování </div>
        </div>
        <div class="col-2">
          <div class="row-1"><? echo $finalDiff ?></div>
        </div>
        <div class="col-3">
          <div class="row-1"><? echo $result ?></div>
        </div>
      </div>
    </div>
    <div class="calc-payment">
      <? echo $result == 'Nedoplatek' ? 'Prosím o úhradu nedoplatku na účet ' . '<b>' . $accountNumber . '</b>' : '' ?>
    </div>
    <div class="date">
      <span>Datum: </span>
      <span><?php date_default_timezone_set('UTC');
            echo date("d.m.Y") ?>
      </span>
    </div>
    <div class="webmark"><i>www.pronajemonline.cz</i></div>
  </div>



</body>

</html>