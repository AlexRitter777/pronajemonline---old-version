<?php

  // Класс служит для создания объекта, работающего с выводом в столбики друг под другом значений добавленных через JQ строк, когда точное количество изначально неизвестно.

  class RunnigValues{
     
    //выводит выбранные текстовые значения из выпадающего списка select
    //текстовые значения должны быть подключены отдельным массивом с числовыми индексами
    //в метод задаем полученные через форму индексы массива с текстовыми полями и сам массив
    public function showSelectListValues($selectListValues, $valuesListArray) {
       foreach ($selectListValues as $value){ //номера значений из списка select
        echo '<div>' . $valuesListArray[$value] . '</div>';
      }
    }

    //метод выписывает друг под другом коэфициенты к значениям, имеющим в текстовом поле определенную подстроку (можно вынести подстроку в аргументы метода для универсальности)
    //альтернативно можно выводить значения не по подстроке, а по индексу элемента в масииве исходнике
    //там где условие не соотв. возвращвет 1 (можно вынести в аргумент возвращаемое згначение)
    public function showCoeficient($selectListValues, $valuesListArray, $coeficient) {

      foreach($selectListValues as $value) {
        $result[] = $valuesListArray["$value"];
      }

      foreach($result as $oneResult){

        if (preg_match("/UT/i", $oneResult)){
          echo "<div>$coeficient</div>";
        } else {
          echo "<div>&emsp;</div>";
        }
      }
    }

  // см. выше. возвращает значения друг за другом в виде массива
  public function getCoeficient($selectListValues, $valuesListArray, $coeficient) {

    foreach ($selectListValues as $value) {
      $result[] = $valuesListArray["$value"];
    }

    foreach ($result as $oneResult) {

      if (preg_match("/UT/i", $oneResult)) {
        $coeficientList[] = $coeficient;
      } else {
        $coeficientList[] = 1;
      }
    }

    return $coeficientList;

  }


    //выписывает числовые значения друг под другом
    public function showRowValues($valuesArray) {
      for ($i=0; $i < count($valuesArray); $i++) {
        echo '<div>' . $valuesArray[$i] . '</div>';
      }
    }

    //выписывает числовые значения друг под другом, разделеные на како-то период -> значение за определенный период
    public function showPeriodRowValues($valuesArray, $period)
    {
      for ($i = 0; $i < count($valuesArray); $i++) {
        echo '<div>' . round(($valuesArray[$i]/$period), 2) . '</div>';
      }
    }



    //выписывает разницу между двумя числовыми значениями одинакового индекса для 2-х массивов
    public function showDiffRowValues($initialValuesArray, $endValuesArray)
    {
      if (count($initialValuesArray) == count($endValuesArray)) {
        for ($i = 0; $i < count($initialValuesArray); $i++) {
          echo '<div>' . ($endValuesArray[$i] - $initialValuesArray[$i]) . '</div>';
        }
      }
      else{
        die("Unexpected error! Please try again later");
      }          
    }

    //возвращает разницу между двумя числовыми значениями одинакового индекса для 2-х массивов

    public function getDiffRowValues($initialValuesArray, $endValuesArray)
    {
      if (count($initialValuesArray) == count($endValuesArray)) {
        for ($i = 0; $i < count($initialValuesArray); $i++) {
          $result[] = $endValuesArray[$i] - $initialValuesArray[$i];
        }
          return $result;        
      } else {
        die("Unexpected error! Please try again later");
      }
    }

    //выписывает массив разниц между двумя числовыми значениями одинакового индекса для 2 массивов значений, умноженную на коэфициент с тем же индексов из заданного массива коэфициентов
    public function showDiffInclCoeficientValues($initialValuesArray, $endValuesArray, $selectListValues, $valuesListArray, $coeficient){
      $coeficientList = $this->getCoeficient($selectListValues, $valuesListArray, $coeficient);
      $diffValuesList = $this->getDiffRowValues($initialValuesArray, $endValuesArray);
      if (count($coeficientList) == count($diffValuesList)) {
        for ($i = 0; $i < count($coeficientList); $i++) {
          echo '<div>' . round(($coeficientList[$i] * $diffValuesList[$i]), 2) . '</div>';
        }
      } else {
        die("Unexpected error!");
      }
    }


   
  }


