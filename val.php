<?php


$errors = []; //validation errors
$data = []; //this variable is sending via ajax back to client side
//array with all errors list. For convenience:  main error indexes in array = global array POST indexes for this error = indexes in $errors array
$errorList = array( 
    'landlordName' => 'Zadejte prosím jméno a přímení/název firmy pronajímatele!',
    'landlordNameLength' => 'Maximální počet symbolů pro jméno a přímení pronajímatele je ',
    'landlordAddress' => 'Zadejte prosím adresu pronajímatele!',
    'landlordAddressLength' => 'Maximální počet symbolů pro adresu pronajímatele je ',

    'propertyAddress' => 'Zadejte prosím adresu nemovitosti!',
    'propertyAddressLength' => 'Maximální počet symbolů pro adresu nemovitosti je ',
    'propertyType' => 'Zadejte prosím popis nemovitosti!',
    'propertyTypeLength' => 'Maximální počet symbolů pro popis nemovitosti je  ',

    'tenantName' => 'Zadejte prosím jméno a přímení/název firmy nájemníka!',
    'tenantNameLength' => 'Maximální počet symbolů pro jméno a přímení/název firmy nájemníka je ',
    'tenantAddress' => 'Zadejte prosím adresu nájemníka!',
    'tenantAddressLength' => 'Maximální počet symbolů pro adresu nájemníka je ',

    'calcStartDate' => 'Zadejte prosím počáteční datum vyúčtování správce!',
    'calcFinishDate' => 'Zadejte prosím koneční datum vyúčtování správce!',
    'calcDifDate' => 'Počáteční datům vyúčtování správce musí být dříve než koneční',
    'calcDifDateYear' => 'Období vyúčtování správce nesmí byt déle než 1 rok',

    'rentStartDate' => 'Zadejte prosím počáteční datum vyúčtování pronajmatele!',
    'rentFinishDate' => 'Zadejte prosím koneční datum vyúčtování pronajmatele!',
    'rentDifDate' => 'Počáteční datům vyúčtování pronajmatele musí být dříve než koneční',
    'rentDifDateYear' => 'Období vyúčtování pronajmatele nesmí byt déle než 1 rok',

    'servicesCost' => 'Výši paušálních nákladů je povinný údaj!',
    'servicesCostLen' => 'Výši paušálních nákladu – max počet symbolů ',
    'servicesCostBelowZero' => 'Náklad nemůže mít zápornou hodnotu!',

    'initialValue' => 'Počáteční stavy všech měřičů je povinný údaj!',
    'initialValueLen' => 'Počáteční stav měřiče  - maximální počet symbolů je ',
    'initialValueBelowZero' => 'Počáteční stav měřiče nemůže mít zápornou hodnotu!',

    'endValue' => 'Koneční stavy všech měřičů je povinný údaj!',
    'endValueLen' => 'Koneční stav měřiče  - maximální počet symbolů je ',
    'endValueBelowZero' => 'Koneční stav měřiče nemůže mít zápornou hodnotu!',
    'difValues' => 'Počáteční stav měřiče nesmí byt vetší než koneční stav!',

    'coefficientValue' => 'Zadejte prosím koeficient/koeficienty pro ústřední topení nebo vyvřete možnost vypočtu bez koeficientů!',
    'coefficientValueLen' => 'Koeficient pro ústřední topení – maximální počet symbolů je ',
    'coefficientValueBelowZero' => 'Koeficient pro ústřední topení nemůže mít zápornou hodnotu!',

    'constHotWaterPrice' => 'Základní složka za ohřev teplé užitkové vody(TUV) je povinný údaj!',
    'constHotWaterPriceLen' => 'Základní složka za ohřev teplé užitkové vody(TUV) - maximální počet symbolů je ',
    'constHotWaterPriceBelowZero' => 'Základní složka za ohřev teplé užitkové vody nemůže mít zápornou hodnotu!',

    'constHeatingPrice' => 'Základní složka za ústřední topení (UT) je povinný údaj!',
    'constHeatingPriceLen' => 'Základní složka za ústřední topení (UT) - maximální počet symbolů je ',
    'constHeatingPriceBelowZero' => 'Základní složka za ústřední topení (UT) nemůže mít zápornou hodnotu!',

    'hotWaterPrice' => 'Cena za ohřev 1 m3 teple užitkové vody (TUV) je povinný údaj!',
    'hotWaterPriceLen' => 'Cena za ohřev 1 m3 teple užitkové vody (TUV) - maximální počet symbolů je ',
    'hotWaterPriceBelowZero' => 'Cena za ohřev 1 m3 teple užitkové vody (TUV) nemůže mít zápornou hodnotu!',

    'coldWaterPrice' => 'Cena za ohřev 1 m3 studené užitkové vody (TUV) je povinný údaj!',
    'coldWaterPriceLen' => 'Cena za ohřev 1 m3 studené užitkové vody (TUV) - maximální počet symbolů je ',
    'coldWaterPriceBelowZero' => 'Cena za ohřev 1 m3 studené užitkové vody (TUV) nemůže mít zápornou hodnotu!',

    'heatingPrice' => 'Cena za jednotku ústředního topení (UT) je povinný údaj!',
    'heatingPriceLen' => 'Cena za jednotku ústředního topení (UT) - maximální počet symbolů je ',
    'heatingPriceBelowZero' => 'Cena za jednotku ústředního topení (UT) nemůže mít zápornou hodnotu!',   

    'advancedPayments' => 'Součet zaloh za služby, zaplacených najmeníkem v ramcích učtovácího období je povinný údaj!',
    'advancedPaymentsLen' => 'Součet zaloh za služby, zaplacených najmeníkem v ramcích učtovácího období - maximální počet symbolů je ',
    'advancedPaymentsBelowZero' => 'Součet zaloh za služby, zaplacených najmeníkem v ramcích učtovácího období nemůže mít zápornou hodnotu!'
);

//FUNCTIONS FOR VALIDATION

//function for cheking incoming Value and Length
function ValidateValueAndLength($value, $length) {
    global $errors;
    global $errorList;
    if (empty($_POST[$value])) {
        $errors[$value] = $errorList[$value];
    }
    if (strlen($_POST[$value]) > $length)
        $errors[$value . 'Length'] = $errorList[$value . 'Length'] . $length . '!';
}

//function for validation of two dates
function twoDatesVal($startDate, $finishDate, $errorDifDate,  $errorDifDateYear) {
    global $errors;
    global $errorList;
    if (empty($_POST[$startDate])) {
        $errors[$startDate] = $errorList[$startDate];
    }

    if (empty($_POST[$finishDate])) {
        $errors[$finishDate] = $errorList[$finishDate];
    }

   //check if start date is not later than end date
    if (!empty($_POST[$finishDate]) &&
        !empty($_POST[$startDate]) &&
        $_POST[$finishDate] <=  $_POST[$startDate]){
            $errors[array_search ($errorDifDate, $errorList)] = $errorDifDate;
    }     

    //check if the period is not more than 1 year
    $startDateVal = new DateTime($_POST[$startDate]);
    $finishDateVal = new DateTime($_POST[$finishDate]);
    $diffVal = $startDateVal->diff($finishDateVal);
    $diffValYears = ($diffVal->format('%y'));
    if($diffValYears >= 1) {
        $errors[array_search ($errorDifDateYear, $errorList)] = $errorDifDateYear;

    }
}

//Function for checking the values of the added fields
function runningValuesValidator ($values, $errorValue, $errorLength, $errorValueBelowZero, $length) {
    global $errors;
    global $errorList;
    $cost = $_POST[$values];
    //define, if there is at least one empty field
    foreach((array)$cost as $oneCost){
        if (empty($oneCost)) {
            $errors[array_search ($errorValue, $errorList)] = $errorValue;
            break;
        }
    }
    //determine, which specific fields are empty
    $h=1;
    foreach((array)$cost as $twoCost){
        if (empty($twoCost)) {
            $errors[array_search ($errorValue, $errorList) . $h] = true;
        }
        else {
           $errors[array_search ($errorValue, $errorList) . $h] = false;//false count is needed for corect working JS validator, we will need all counts: true and false
        }
    $h++;
    }
    //determine, if at least one value exceeds the maximum length   
    foreach((array)$cost as $threeCost) {
        if (strlen($threeCost) > $length) {
            $errors[array_search ($errorLength, $errorList)] = $errorLength . $length . '!';
        break;
        }
    }
    //determine, which specific fields exceeds the maximum length 
    $l=1;
    foreach((array)$cost as $fourCost){
        if (strlen($fourCost) > $length) {
            $errors[array_search ($errorLength, $errorList) . $l] = true;
        }
        else {
            $errors[array_search ($errorLength, $errorList) . $l] = false;//false count is needed for corect working JS validator, we will need all counts: true and false
        }
    $l++;
    }
    //determine if at least one value is less than zero
    foreach((array)$cost as $fiveCost) {
        if ($fiveCost < 0) {
            $errors[array_search ($errorValueBelowZero, $errorList)] = $errorValueBelowZero;
        break;
        }
    }
    //determine, which specific fields are is less than zero 
    $m=1;
    foreach((array)$cost as $sixCost){
        if ($sixCost < 0) {
            $errors[array_search ($errorValueBelowZero, $errorList) . $m] = true;
        }
        else {
            $errors[array_search ($errorValueBelowZero, $errorList) . $m] = false; //false count is needed for corect working JS validator, we will need all counts: true and false
        }
    $m++;
    }
}

//function for validation incoming integer and float Numbers on Value, Max Length and compare with zero
function ValidateValueLengthZero($value, $length) {
    global $errors;
    global $errorList;
    if (empty($_POST[$value])) {
        $errors[$value] = $errorList[$value];
    }
    if (strlen($_POST[$value]) > $length)
        $errors[$value . 'Len'] = $errorList[$value . 'Len'] . $length . '!';
    if ($_POST[$value] < 0) 
        $errors[$value . 'BelowZero'] = $errorList[$value . 'BelowZero'];
    
}

//function for validation incoming integer and float Numbers only on Max Length and compare with zero
function ValidateLengthAndZero($value, $length) {
    global $errors;
    global $errorList;
    if (strlen($_POST[$value]) > $length)
        $errors[$value . 'Len'] = $errorList[$value . 'Len'] . $length . '!';
    if ($_POST[$value] < 0) 
        $errors[$value . 'BelowZero'] = $errorList[$value . 'BelowZero'];
}

ValidateValueAndLength('landlordName', 20);
ValidateValueAndLength('landlordAddress', 35);
ValidateValueAndLength('propertyAddress', 35);
ValidateValueAndLength('propertyType', 20);
ValidateValueAndLength('tenantName', 20);
ValidateValueAndLength('tenantAddress', 35);

twoDatesVal(
    'calcStartDate',
    'calcFinishDate',
    $errorList['calcDifDate'],
    $errorList['calcDifDateYear']
);
twoDatesVal(
    'rentStartDate',
    'rentFinishDate',
    $errorList['rentDifDate'],
    $errorList['rentDifDateYear']
);

runningValuesValidator (
    'servicesCost_array',
    $errorList['servicesCost'],
    $errorList['servicesCostLen'],
    $errorList['servicesCostBelowZero'],
    3
);

runningValuesValidator (
    'initialValue_array',
    $errorList['initialValue'],
    $errorList['initialValueLen'],
    $errorList['initialValueBelowZero'],
    5
);

runningValuesValidator (
    'endValue_array',
    $errorList['endValue'],
    $errorList['endValueLen'],
    $errorList['endValueBelowZero'],
    5
);

//Validation of Start and End nubers values. Here we validate than end value is not less than start value. There is no function
$initialValues = $_POST['initialValue_array'];
$endValues = $_POST['endValue_array'];
$countInitialValueArray = count($_POST['initialValue_array']);
$countEndValueArray = count($_POST['endValue_array']);
if ($countInitialValueArray == $countEndValueArray) {
    for ($x = 1; $x <= $countEndValueArray; $x++) {
        if (
           (!$errors["initialValue$x"]) &&
           (!$errors["initialValueLen$x"]) &&
           (!$errors["endValue$x"]) &&
           (!$errors["endValueLen$x"])
           ) 
        {
           if ($initialValues[''.($x-1).''] > $endValues[''.($x-1).'']) {
            $errors['difValues'] = $errorList['difValues'];
            break; 
           } 
        }
    }

    for ($x = 1; $x <= $countEndValueArray; $x++) {
        if (
           (!$errors["initialValue$x"]) &&
           (!$errors["initialValueLen$x"]) &&
           (!$errors["endValue$x"]) &&
           (!$errors["endValueLen$x"])
           ) 
        {
            if ($initialValues[''.($x-1).''] > $endValues[''.($x-1).'']) {
               $errors["difValues$x"] = true;
            } 
        }
    }
 
}
else {
    die('Unexpected error! Please try again later!');
}

//for coefficient we should ckeck if user chosed a radio button and fields were created and sent by POST array
if (isset($_POST['coefficientValue_array'])){
    runningValuesValidator (
    'coefficientValue_array',
    $errorList['coefficientValue'],
    $errorList['coefficientValueLen'],
    $errorList['coefficientValueBelowZero'],
    5
    );
} 

ValidateValueLengthZero('constHotWaterPrice', 4);
ValidateValueLengthZero('constHeatingPrice', 4);
ValidateValueLengthZero('hotWaterPrice', 4);
ValidateValueLengthZero('coldWaterPrice', 4);
ValidateValueLengthZero('heatingPrice', 4);

ValidateLengthAndZero('advancedPayments', 4);

//here we chek if in our $errors array remained only Boolean: false values. It means that there are not any errors in array. If there are any errors aor true values that confim errors also we stay in validation.
if (!array_sum($errors) == 0) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
}

echo json_encode($data);


?>