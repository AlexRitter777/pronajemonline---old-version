<?php

namespace app\models;

use DateTime;

class Applications extends AppModel {




    public function load($data) {
        foreach ($this->attributes as $name => $value) {
            if(isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function servicesCalculation(){


        //Находим разницы для начальных и конечных дат
        $this->attributes['calcDifMonth'] = $this->twoDatesMonthDiff($this->attributes['calcStartDate'], $this->attributes['calcFinishDate']);
        $this->attributes['rentDifMonth'] = $this->twoDatesMonthDiff($this->attributes['rentStartDate'], $this->attributes['rentFinishDate']);

        //Находим общие суммы показаний счетчиков
        $this->attributes['hotWaterSum'] = $this->metersDifSum('TUV', $this->attributes['appMeters'], $this->attributes['initialValue'], $this->attributes['endValue']);
        $this->attributes['coldWaterSum'] = $this->metersDifSum('SUV', $this->attributes['appMeters'], $this->attributes['initialValue'], $this->attributes['endValue']);
        $this->attributes['heatingSum'] = $this->metersDifSum('UT', $this->attributes['appMeters'], $this->attributes['initialValue'], $this->attributes['endValue']);

        //Проверяем наличие коффициента и подставляем его или 1. Метод используется в meterDifSum
        $this->attributes['finalCoefficient'] = $this->coefficientUT($this->attributes['coefficientValue']);

        //Находим общие паушальные расходы и расходы за месяц: подэлементы массива commonCosts и costPerPeriod
        $this->attributes['servicesCostTotal'] = $this->costsPerPeriod($this->attributes['calcDifMonth'], $this->attributes['servicesCost']);

        //Находим стоимость закл. сложек TUV и UT, их сумму и сумму за 1 месяц
        $this->attributes['hotWaterConstTotal'] = $this->costsPerPeriod($this->attributes['calcDifMonth'], array($this->attributes['constHotWaterPrice']));
        $this->attributes['heatingConstTotal'] = $this->costsPerPeriod($this->attributes['calcDifMonth'], array($this->attributes['constHeatingPrice']));
        $this->attributes['costsConstTotal'] = $this->costsPerPeriod($this->attributes['calcDifMonth'], array($this->attributes['hotWaterConstTotal']['commonCosts'], $this->attributes['heatingConstTotal']['commonCosts']));

        //Находим стоим. потребленных сложекб их общую сумму и сумму за 1 мес.
        $this->attributes['hotWaterVarTotal'] = $this->totalValue($this->attributes['hotWaterPrice'], $this->attributes['hotWaterSum']);
        $this->attributes['coldWaterVarTotal'] = $this->totalValue($this->attributes['coldWaterPrice'], $this->attributes['coldWaterSum']);
        $this->attributes['coldForHotWaterVarTotal'] = $this->totalValue($this->attributes['coldWaterPrice'], $this->attributes['hotWaterSum']);
        $this->attributes['heatingVarTotal'] = $this->totalValue($this->attributes['heatingPrice'], $this->attributes['heatingSum']);
        $this->attributes['costsVarTotal'] = $this->costsPerPeriod($this->attributes['rentDifMonth'], array($this->attributes['hotWaterVarTotal'], $this->attributes['coldWaterVarTotal'], $this->attributes['heatingVarTotal'], $this->attributes['coldForHotWaterVarTotal']));

        //Находим итоговые суммы за период аренды для паушальных накладов, закладних сложек и спотребних сложек
        $this->attributes['servicesCostRentTotal'] = $this->totalValue($this->attributes['servicesCostTotal']['costsPerPeriod'], $this->attributes['rentDifMonth']);
        $this->attributes['costsConstRentTotal'] = $this->totalValue($this->attributes['costsConstTotal']['costsPerPeriod'], $this->attributes['rentDifMonth']);
        $this->attributes['costsVarRentTotal'] = $this->totalValue($this->attributes['costsVarTotal']['costsPerPeriod'], $this->attributes['rentDifMonth']);
        $this->attributes['allCostsTotal'] = $this->costsPerPeriod($this->attributes['rentDifMonth'], array($this->attributes['servicesCostRentTotal'], $this->attributes['costsConstRentTotal'], $this->attributes['costsVarRentTotal']));
        $this->attributes['calculationResult'] = $this->finalCalculation($this->attributes['advancedPayments'], $this->attributes['allCostsTotal']['commonCosts']);



        return $this->attributes;
    }


    public function electroCalculation(){

        //Находим разницы для начальных и конечных дат
        $this->attributes['rentDifMonth'] = $this->twoDatesMonthDiff($this->attributes['rentStartDate'], $this->attributes['rentFinishDate']);
        //Находим потребление электрики в кВт
        $this->attributes['diffElectroKWh'] =  $this->diffValue($this->attributes['initialValueOne'], $this->attributes['endValueOne']);
        //Находим итоговые стоимости по киловатам и по месяцам
        $this->attributes['totalElectroMonths'] = $this->totalValue($this->attributes['rentDifMonth'], $this->attributes['electroPriceMonth']);
        $this->attributes['totalElectroKWh'] = $this->totalValue($this->attributes['diffElectroKWh'], $this->attributes['electroPriceKWh']);
        //Находим общие расходы и расходы за месяц и делаем финальное выучтование
        $this->attributes['allCostsTotal'] = $this->costsPerPeriod($this->attributes['rentDifMonth'], array($this->attributes['totalElectroMonths'], $this->attributes['totalElectroKWh']));
        $this->attributes['calculationResult'] = $this->finalCalculation($this->attributes['advancedPayments'], $this->attributes['allCostsTotal']['commonCosts']);

        return $this->attributes;

    }

    public function depositCalculation() {

        //Переводим элементы недоплаты на отрицательные значения
        $this->attributes['depositItemsPrice'] = $this->zeroArrayConversion($this->attributes['depositItems'], $this->attributes['depositItemsPrice']);

        //Находим разницу переплат и недоплат. Период принимаем за 1.
        $this->attributes['finalDepositDiff'] = $this->costsPerPeriod(1, $this->attributes['depositItemsPrice']);
        $this->attributes['finalDepositDiff']['commonCosts'] = $this->zeroConversion($this->attributes['finalDepositDiff']['commonCosts']);
        //Финальное выучтование
        $this->attributes['depositResult'] = $this->finalCalculation($this->attributes['deposit'], $this->attributes['finalDepositDiff']['commonCosts']);


        return $this->attributes;
    }


    public function twoDatesMonthDiff($startDate, $finishDate, $precision = 2) {

        $startDateObj = new DateTime($startDate);
        $finishDateObj = new DateTime($finishDate);
        $diff = $startDateObj->diff($finishDateObj);
        $totalMonthsDiff = (($diff->format('%y') * 12) + $diff->format('%m') + ($diff->format('%d')) / 30);
        return round($totalMonthsDiff, $precision);

    }

    public function metersDifSum($utility, $names = [], $initialValues = [], $endValues = []){
        $i = 0;
        $result = 0;
        foreach ($names as $name) {
            if (preg_match("/{$utility}/", $name)) {
                $result = $result + ($endValues[$i] - $initialValues[$i]);
            }
            $i++;
        }
        if ($utility == 'UT'){
            $coefficient = $this->coefficientUT($this->attributes['coefficientValue']);
            $result = round(($result * $coefficient),  2);
        }
        return $result;

    }

    public function coefficientUT($coefficientArray){
        if (isset($coefficientArray)){
            $finalCoefficient = round(array_product($coefficientArray), 3);
        } else {
            $finalCoefficient = 1;
        }
        return $finalCoefficient;
    }

    public function costsPerPeriod($period,$costs=[]){

        $result['commonCosts'] = array_sum($costs);
        $result['costsPerPeriod'] = round($result['commonCosts']/$period, 2);
        return $result;
    }

    public function totalValue($quantity, $value) {

        return round ($quantity * $value, 2);

    }

    public function diffValue($startValue, $endValue) {

        return $endValue - $startValue;

    }

    public function zeroArrayConversion ($desc = [], $values = []) {


            for ($i = 0; $i < count($desc); $i++) {
                if ($desc[$i]) {
                    if ((preg_match('~Nedoplatek~', $desc[$i])) || (preg_match('~Váda/poškození~', $desc[$i]))) {
                        $values[$i] = $values[$i] * (-1);
                    }
                }

            }


        return $values;

    }

    public function zeroConversion ($value) {
        return $value * (-1);
    }

    public function finalCalculation($advancedPayments, $totalCosts){
        $diff = $advancedPayments - $totalCosts;
        if($diff >= 0) {
            $result['value'] = $diff;
            $result['text'] = 'Přeplatek';
        } else if ($diff = 0) {
            $result['value'] = $diff;
            $result['text'] = '';
        } else {
            $result['value'] = $diff;
            $result['text'] = 'Nedoplatek';
        }
        return $result;


    }






}