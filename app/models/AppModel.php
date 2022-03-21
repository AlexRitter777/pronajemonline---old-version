<?php

namespace app\models;

use pronajem\base\Model;


class AppModel extends Model {

    public $attributes = [
        'landlordName' => '', //services, electro, deposit
        'landlordAddress' =>'', //services, electro, deposit
        'accountNumber' => '', //services, electro, deposit
        'propertyAddress' => '', //services, electro, deposit
        'propertyType' => '', //services, electro, deposit
        'tenantName' => '', //services, electro, deposit
        'tenantAddress' => '', //services, electro, deposit
        'adminName' => '', //services
        'supplierName' => '', //electro
        'calcStartDate' => '', //services
        'calcFinishDate' => '', //services
        'rentStartDate' => '', //services, electro, deposit
        'rentFinishDate' => '', //services, electro, deposit
        'rentFinishReason' => '', //deposit
        'initialValueOne' => '', //electro
        'endValueOne' => '', //electro
        'meterNumberOne' => '', //electro
        'pausalniNaklad' => [], //services
        'servicesCost' => [], //services
        'appMeters' => [], //services
        'initialValue' => [], //services
        'endValue' => [], //services
        'meterNumber' => [], //services
        'originMeterStart' => '', //services, electro
        'originMeterEnd' => '', //services, electro
        'coefficient' => '', //services
        'coefficientValue' => [], //services
        'constHotWaterPrice' => '', //services
        'constHeatingPrice' => '', //services
        'hotWaterPrice' => '', //services
        'coldWaterPrice' => '', //services
        'coldForHotWaterPrice' => '', //services
        'heatingPrice' => '', //services
        'electroPriceKWh' => '', //electro
        'electroPriceMonth' => '', //electro
        'depositItems' => [], //deposit
        'depositItemsPrice' => [], //deposit
        'itemsStartDate' => [], //deposit
        'itemsStartDateStyle' => [], //deposit
        'itemsFinishDate' => [], //deposit
        'itemsFinishDateStyle' => [], //deposit
        'damageDesc' => [], //deposit
        'damageDescStyle' => [], //deposit
        'advancedPayments' => '', //services, electro
        'deposit' => '' // deposit


    ];



}