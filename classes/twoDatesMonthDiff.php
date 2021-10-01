<?php

//Класс для определения разницы между 2 датами в месяцах


class twoDatesMonthDiff{

  private $startDateObj;
  private $finishDateObj;

  public function __construct($startDate, $finishDate)
  {
    $this->startDateObj = new  DateTime($startDate);
    $this->finishDateObj = new  DateTime($finishDate);
  }

  public function czDateformat($DateObj){

  }

  public function twoDatesMonthDiff()
  {
    $diff = ($this->startDateObj)->diff($this->finishDateObj);
    $totalMonthsDiff = (($diff->format('%y') * 12) + $diff->format('%m') + ($diff->format('%d')) / 30);
    $totalMonthsDiffRound = round($totalMonthsDiff, 1);
    return $totalMonthsDiffRound;
  }

}

