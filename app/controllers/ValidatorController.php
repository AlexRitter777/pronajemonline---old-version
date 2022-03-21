<?php

namespace app\controllers;

use app\models\Validation;

class ValidatorController extends AppController {

    public function servicesvalidationAction() {

        $data = $_POST;
        $validate = new Validation();
        $validate->load($data);
        $validate->validateServices();
        echo json_encode($validate->data);


        die();

    }

    public function electrovalidationAction() {

        $data = $_POST;
        $validate = new Validation();
        $validate->load($data);
        $validate->validateElectro();
        echo json_encode($validate->data);


        die();

    }

    public function depositvalidationAction() {

        $data = $_POST;
        $validate = new Validation();
        $validate->load($data);
        $validate->validateDeposit();
        echo json_encode($validate->data);


        die();

    }



}