<?php

namespace app\controllers;

use app\models\Services;
use pronajem\base\Controller;

class ServicesController extends AppController
{

    public function servicesAction(){

       $modelObject = new Services();
       $modelObject->getJsonList($modelObject->services);
       die();

    }

    public function simplyservicesAction(){

        $modelObject = new Services();
        $modelObject->getSimplyList($modelObject->services);
        die();

    }

    public function metersAction(){

        $modelObject = new Services();
        $modelObject->getJsonList($modelObject->meters);
        die();

    }

    public function simplymetersAction(){

        $modelObject = new Services();
        $modelObject->getSimplyList($modelObject->meters);
        die();

    }

    public function originsAction(){

        $modelObject = new Services();
        $modelObject->getJsonList($modelObject->origins);
        die();

    }

    public function originselectroAction(){
        $modelObject = new Services();
        $modelObject->getJsonList($modelObject->originsElectro);
        die();
    }

    public function rentfinishreasonsAction(){

        $modelObject = new Services();
        $modelObject->getJsonList($modelObject->rentFinishReasons);
        die();

    }

    public function deposititemsAction(){

        $modelObject = new Services();
        $modelObject->getJsonList($modelObject->depositItems);
        die();

    }

    public function simplydeposititemsAction(){

        $modelObject = new Services();
        $modelObject->getSimplyList($modelObject->depositItems);
        die();

    }






}