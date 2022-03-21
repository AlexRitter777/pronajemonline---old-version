<?php

namespace app\models;
use DateTime;

class Validation extends AppModel {


    public $errors = [];
    public $errorsBool = [];
    public $data = [];
    public $desc = Array(
        'landlordName' => 'Jméno a přímení/název firmy pronajímátele', //S, E
        'landlordAddress' => 'Adresa pronajímatele', //S, E
        'accountNumber' => 'Číslo účtu', //S, E
        'propertyAddress' => 'Adresa nemovitosi', //S, E
        'propertyType' => 'Popis nemovitosi', //S, E
        'tenantName' => 'Jméno a přímení/název firmy najemnika', //S, E
        'tenantAddress' => 'Adresa nájemníka', //S, E
        'adminName' => 'Nazev firmy spravce', //S
        'supplierName' =>'Nazev dodavatele elektřiny', //E
        'calcStartDate' => 'Počáteční datum vyúčtování správce', //S
        'calcFinishDate' => 'Koneční datum vyúčtování správce', //S
        'rentStartDate' => 'Počáteční datum vyúčtování pronajmatele', //S, E
        'rentFinishDate' => 'Koneční datum vyúčtování pronajmatele', //S, E
        'rentFinishReason' => 'Důvod úkončení nájmu', //D
        'pausalniNaklad' => 'Paušální náklad',
        'initialValueOne' => 'Počáteční stav elektroměru', //E
        'endValueOne' => 'Koneční stav elektroměru', //E
        'meterNumberOne' => 'Výrobní číslo elektroměru', //E
        'servicesCost' => 'Výši paušálních nákladů', //S
        'appMeters' => 'Druh měřiče', //S
        'initialValue' => 'Počáteční stavy měřičů', //S
        'endValue' => 'Koneční stavy měřičů', //S
        'meterNumber' => 'Vyrobní čísla měřičů', //S
        'coefficientValue' => 'Koeficient/koeficienty pro ústřední topení', //S
        'constHotWaterPrice' => 'Základní složka za ohřev teplé užitkové vody(TUV)', //S
        'constHeatingPrice' => 'Základní složka za ústřední topení (UT)', //S
        'hotWaterPrice' => 'Cena za ohřev 1 m3 teple užitkové vody (TUV)', //S
        'coldWaterPrice' => 'Cena za ohřev 1 m3 studené užitkové vody (SUV)', //S
        'coldForHotWaterPrice' => 'Cena za ohřev 1 m3 studené užitkové vody, použité pro přípravu teplé užitkové vody (SUV pro TUV)', //S
        'heatingPrice' => 'Cena za jednotku ústředního topení (UT)', //S
        'electroPriceKWh' => 'Průměrná jednotková cena za kWh', //E
        'electroPriceMonth' => 'Průměrná jednotková cena za měsíc', //E
        'depositItems' =>'Položky výučtování', //D
        'depositItemsPrice' =>'Cena položky výučtování', //D
        'itemsStartDate' =>'Počáteční datum vyúčtování v položce', //D
        'itemsFinishDate' =>'Koneční datum vyúčtování v položce', //D
        'damageDesc' => 'Popis vady/poškození v položce', //D
        'advancedPayments' => 'Součet zaloh za služby, zaplacených najmeníkem', //S, E
        'deposit' => 'Vyše kauci'

    );
    public $regex = '~^[a-zěščřžýáíéúů0-9 ,/-]{1,}$~ui';

    public function load($data) {
        foreach ($this->attributes as $name => $value) {
            if(isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validateServices (){

        $this->validateValue('landlordName');
        $this->validateLength('landlordName', 5);
        $this->validateChars('landlordName');

        $this->validateValue('landlordAddress');
        $this->validateLength('landlordAddress',6);
        $this->validateChars('landlordAddress');

        //$this->validateValue('accountNumber');
        $this->validateAccNumber('accountNumber');

        $this->validateValue( 'propertyAddress');
        $this->validateLength('propertyAddress',6);
        $this->validateChars('propertyAddress');

        $this->validateValue( 'propertyType');
        $this->validateLength('propertyType',6);
        $this->validateChars('propertyType');

        $this->validateValue( 'tenantName');
        $this->validateLength('tenantName',6);
        $this->validateChars('tenantName');

        $this->validateValue( 'tenantAddress');
        $this->validateLength('tenantAddress',6);
        $this->validateChars('tenantAddress');

        //$this->validateValue( 'adminName');
        $this->validateLength('adminName',6);
        $this->validateChars('adminName');

        $this->validateValue( 'calcStartDate');
        $this->validateValue('calcFinishDate');
        $this->comparingTwoDates('calcStartDate', 'calcFinishDate', 'calcDiffDates');
        $this->validateYearsInterval('calcStartDate', 'calcFinishDate', 1, 'calcIntervalDates');

        $this->validateValue( 'rentStartDate');
        $this->validateValue('rentFinishDate');
        $this->comparingTwoDates('rentStartDate', 'rentFinishDate', 'rentDiffDates');

        $this->validateAddedRowsValue('pausalniNaklad');
        $this->validateAddedRowsChar('pausalniNaklad');
        $this->validateAddedRowsLength('pausalniNaklad', 15);

        $this->validateAddedRowsValue('servicesCost');
        $this->validateAddedRowsLength('servicesCost', 10);
        $this->validateAddedRowsZero('servicesCost');

        $this->validateAddedRowsValue('appMeters');

        $this->validateAddedRowsValue('initialValue');
        $this->validateAddedRowsLength('initialValue', 6);
        $this->validateAddedRowsZero('initialValue');

        $this->validateAddedRowsValue('endValue');
        $this->validateAddedRowsLength('endValue', 6);
        $this->validateAddedRowsZero('endValue');

        $this->validateAddedRowsValue('meterNumber');
        $this->validateAddedRowsLength('meterNumber', 6);
        $this->validateAddedRowsZero('meterNumber');

        $this->validateCoefficient('coefficientValue', 5);

        $this->validateValue( 'constHotWaterPrice');
        $this->validateLength('constHotWaterPrice',6);
        $this->validateZero('constHotWaterPrice');

        $this->validateValue( 'constHeatingPrice');
        $this->validateLength('constHeatingPrice',6);
        $this->validateZero('constHeatingPrice');

        $this->validateValue( 'hotWaterPrice');
        $this->validateLength('hotWaterPrice',6);
        $this->validateZero('hotWaterPrice');

        $this->validateValue( 'coldWaterPrice');
        $this->validateLength('coldWaterPrice',6);
        $this->validateZero('coldWaterPrice');

        $this->validateValue( 'coldForHotWaterPrice');
        $this->validateLength('coldForHotWaterPrice',6);
        $this->validateZero('coldForHotWaterPrice');

        $this->validateValue( 'heatingPrice');
        $this->validateLength('heatingPrice',6);
        $this->validateZero('heatingPrice');

        $this->validateLength('advancedPayments',6);
        $this->validateZero('advancedPayments');

        if ($this->errors) {
            $this->data['errors'] = $this->errors;
            $this->data['errorsBool'] = $this->errorsBool;
            $this->data['success'] = false;
        } else {
            $this->data['success'] = true;
        }


    }

    public function validateElectro(){

        $this->validateValue('landlordName');
        $this->validateLength('landlordName', 5);
        $this->validateChars('landlordName');

        $this->validateValue('landlordAddress');
        $this->validateLength('landlordAddress',6);
        $this->validateChars('landlordAddress');

        $this->validateAccNumber('accountNumber');

        $this->validateValue( 'propertyAddress');
        $this->validateLength('propertyAddress',6);
        $this->validateChars('propertyAddress');

        $this->validateValue( 'propertyType');
        $this->validateLength('propertyType',6);
        $this->validateChars('propertyType');

        $this->validateValue( 'tenantName');
        $this->validateLength('tenantName',6);
        $this->validateChars('tenantName');

        $this->validateValue( 'tenantAddress');
        $this->validateLength('tenantAddress',6);
        $this->validateChars('tenantAddress');

        $this->validateLength('supplierName',6);
        $this->validateChars('supplierName');

        $this->validateValue( 'rentStartDate');
        $this->validateValue('rentFinishDate');
        $this->comparingTwoDates('rentStartDate', 'rentFinishDate', 'rentDiffDates');

        $this->validateValue( 'initialValueOne');
        $this->validateLength('initialValueOne',6);
        $this->validateZero('initialValueOne');

        $this->validateValue( 'endValueOne');
        $this->validateLength('endValueOne',6);
        $this->validateZero('endValueOne');

        $this->validateValue( 'meterNumberOne');
        $this->validateLength('meterNumberOne',6);
        $this->validateZero('meterNumberOne');

        $this->validateValue( 'electroPriceKWh');
        $this->validateLength('electroPriceKWh',6);
        $this->validateZero('electroPriceKWh');

        $this->validateValue( 'electroPriceMonth');
        $this->validateLength('electroPriceMonth',6);
        $this->validateZero('electroPriceMonth');

        $this->validateLength('advancedPayments',6);
        $this->validateZero('advancedPayments');


        if ($this->errors) {
            $this->data['errors'] = $this->errors;
            $this->data['errorsBool'] = $this->errorsBool;
            $this->data['success'] = false;
        } else {
            $this->data['success'] = true;
        }


    }

    public function validateDeposit() {

        $this->validateValue('landlordName');
        $this->validateLength('landlordName', 5);
        $this->validateChars('landlordName');

        $this->validateValue('landlordAddress');
        $this->validateLength('landlordAddress',6);
        $this->validateChars('landlordAddress');

        $this->validateAccNumber('accountNumber');

        $this->validateValue( 'propertyAddress');
        $this->validateLength('propertyAddress',6);
        $this->validateChars('propertyAddress');

        $this->validateValue( 'propertyType');
        $this->validateLength('propertyType',6);
        $this->validateChars('propertyType');

        $this->validateValue( 'tenantName');
        $this->validateLength('tenantName',6);
        $this->validateChars('tenantName');

        $this->validateValue( 'tenantAddress');
        $this->validateLength('tenantAddress',6);
        $this->validateChars('tenantAddress');

        $this->validateValue( 'rentStartDate');
        $this->validateValue('rentFinishDate');
        $this->comparingTwoDates('rentStartDate', 'rentFinishDate', 'rentDiffDates');

        $this->validateAddedRowsValue('depositItems');

        $this->validateAddedRowsValue('depositItemsPrice');
        $this->validateAddedRowsZero('depositItemsPrice');
        $this->validateAddedRowsLength('depositItemsPrice', 15);

        $this->validateAddedRowsValueInside('itemsStartDate', 'itemsStartDateStyle');

        $this->validateAddedRowsValueInside('itemsFinishDate', 'itemsFinishDateStyle');

        $this->validateAddedRowsValueInside('damageDesc','damageDescStyle');
        $this->validateAddedRowsChar('damageDesc');
        $this->validateAddedRowsLength('damageDesc', 15);

        $this->validateValue( 'deposit');
        $this->validateLength('deposit',6);
        $this->validateZero('deposit');

        if ($this->errors) {
            $this->data['errors'] = $this->errors;
            $this->data['errorsBool'] = $this->errorsBool;
            $this->data['success'] = false;
        } else {
            $this->data['success'] = true;
        }

    }


    public function validateValue($name){
        if (empty($this->attributes[$name])) {
            $this->errors[$name] = '"' . $this->desc[$name] . '" ' . 'je povinný údaj!';
        }
    }

    public function validateLength($name,$length) {
        if (strlen($this->attributes[$name]) > $length) {
            $this->errors[$name] = 'Maximální počet symbolů pro "' . $this->desc[$name] . ' " ' . 'je ' . $length . '!';
        }

    }


    public function validateChars($name){
        if (!preg_match("$this->regex", $this->attributes[$name]) && ($this->attributes[$name])){
            $this->errors[$name] = "{$this->desc[$name]} obsahuje nepovolené znaky!";
        }
    }


    public function validateZero($name) {
        if ($this->attributes[$name] < 0) {
            $this->errors[$name] = "\"{$this->desc[$name]}\" nemůže mít zápornou hodnotu!";
        }

    }

    public function validateAccNumber($name){
        if (!empty($this->attributes[$name])) {
            if (!preg_match('~^(([0-9]{0,6})-)?([0-9]{1,10})/[0-9]{4}$~', $this->attributes[$name] )){
                $this->errors[$name] = "{$this->desc[$name]} musí byt ve formátu xxxxxx - xxxxxxxxxx/xxxx. Předčíslí není povinné.'";
            }

            if (mb_substr($this->attributes[$name], 0, 1) == '-') {
                $this->errors[$name] = "{$this->desc[$name]} se nemůže začínat symbolem \"-\" !";
            }
        }
    }

    public function comparingTwoDates($startDateName, $finishDateName, $errorName) {
        if (!empty($this->attributes[$startDateName]) && !empty($this->attributes[$finishDateName])) {
                $startDateObject = new DateTime($this->attributes[$startDateName]);
                $finishDateObject = new DateTime($this->attributes[$finishDateName]);
                if ($finishDateObject <= $startDateObject) {
                    $this->errors[$errorName] = "\"{$this->desc[$startDateName]}\" musí byt dříve než \"{$this->desc[$finishDateName]}\"!";
                }
        }

    }

    public function validateYearsInterval($startDateName, $finishDateName, $interval, $errorName) {
        if (!empty($this->attributes[$startDateName]) && !empty($this->attributes[$finishDateName])) {
            $startDateObject = new DateTime($this->attributes[$startDateName]);
            $finishDateObject = new DateTime($this->attributes[$finishDateName]);
            $diffDates = $startDateObject->diff($finishDateObject);
            $diffDates = $diffDates->format('%y');
            if ($diffDates >= $interval) {
                $this->errors[$errorName] = "Období mezí \"{$this->desc['calcStartDate']}\" a \"{$this->desc['calcFinishDate']}\" nesmí byt déle než 1 rok!";
            }
        }

    }


    public function validateAddedRowsValue($names){

        foreach($this->attributes[$names] as $name){
            if (empty($name)) {
                $this->errors[$names . 'Value'] = "\"{$this->desc[$names]}\" je povinný údaj!";
                break;
            }

        }

        foreach ($this->attributes[$names] as $index => $name){
            if (empty($name)){
                $this->errorsBool[$names . 'Value'][($index+1)] = true;
            } else {
                $this->errorsBool[$names . 'Value'][($index+1)] = false;
            }
        }

    }

    public function validateAddedRowsChar($names){

        foreach($this->attributes[$names] as $name){
            if (!preg_match("$this->regex", $name) && ($name)) {
                $this->errors[$names . 'Char'] = "\"{$this->desc[$names]}\" obsahuje nepovolené znaky!";
                break;
            }

        }

       foreach ($this->attributes[$names] as $index => $name){
            if (!preg_match("$this->regex", $name) && ($name)){
                $this->errorsBool[$names . 'Char'][($index+1)] = true;
            } else {
                $this->errorsBool[$names . 'Char'][($index+1)] = false;
            }
        }

    }

    public function validateAddedRowsLength($names, $length){

        foreach ($this->attributes[$names] as $name){
            if (strlen($name) > $length) {
                $this->errors[$names . 'Length'] = "Maximální počet symbolů pro \"{$this->desc[$names]}\" je {$length}!";
                break;
            }

        }

        foreach ($this->attributes[$names] as $index => $name){

            if ((strlen($name) > $length) && ($name)){
                $this->errorsBool[$names . 'Length'][($index+1)] = true;
            } else {
                $this->errorsBool[$names . 'Length'][($index+1)] = false;
            }

        }



    }



    public function validateAddedRowsZero($names){

        foreach ($this->attributes[$names] as $name){
            if ($name < 0 && $name) {
                $this->errors[$names . 'Zero'] = "\"{$this->desc[$names]}\" nemůže mít zápornou hodnotu!";
                break;
            }

        }

        foreach ($this->attributes[$names] as $index => $name){

            if ($name < 0 && $name){
                $this->errorsBool[$names . 'Zero'][($index+1)] = true;
            } else {
                $this->errorsBool[$names . 'Zero'][($index+1)] = false;
            }

        }



    }

    public function validateCoefficient($names, $length){

        if ($this->attributes[$names]){

            $this->validateAddedRowsValue($names);
            $this->validateAddedRowsLength($names, $length);
            $this->validateAddedRowsZero($names);

        }


    }


    public function validateAddedRowsValueInside($names, $styles){


        for ($i=0; $i<count($this->attributes[$names]); $i++) {
            if (empty($this->attributes[$names][$i]) && empty($this->attributes[$styles][$i])) {
                $this->errors[$names . 'Value'] = "\"{$this->desc[$names]}\" je povinný údaj!";
                break;
            }

        }

        for ($i=0; $i<count($this->attributes[$names]); $i++){
            if (empty($this->attributes[$names][$i]) && empty($this->attributes[$styles][$i])){
                $this->errorsBool[$names . 'Value'][($i+1)] = true;
            } else {
                $this->errorsBool[$names . 'Value'][($i+1)] = false;
            }
        }

    }





}