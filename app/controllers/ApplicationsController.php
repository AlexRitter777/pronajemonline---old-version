<?php

namespace app\controllers;

use app\models\Applications;
use Mpdf\Mpdf;

class ApplicationsController extends AppController {


    public function indexAction()
    {

        $this->setMeta('Aplikace', 'Description', 'Key, Words, pronajemonline');
    }

    public function servicesformAction() {
        $this->setMeta('Vyúčtování služeb', 'Description', 'Key, Words, pronajemonline');

        $data = null;

        $this->set(compact('data'));
    }


    public function electroformAction() {
        $this->setMeta('Vyúčtování spotřeby elektřiny', 'Description', 'Key, Words, pronajemonline');

        $data = null;

        $this->set(compact('data'));
    }


    public function depositformAction() {
        $this->setMeta('Vyúčtování kauce', 'Description', 'Key, Words, pronajemonline');

        $data = null;

        $this->set(compact('data'));


    }


    public function electroformeditAction() {
        $this->setMeta('Vyúčtování spotřeby elektřiny', 'Description', 'Key, Words, pronajemonline');
        if(isset($_SESSION['electroResult'])) {
            $data = $_SESSION['electroResult'];
            unset($_SESSION['electroResult']);
        } else {
            $data = null;
        }
        $this->set(compact('data'));
    }

    public function servicesformeditAction() {
        $this->setMeta('Vyúčtování služeb', 'Description', 'Key, Words, pronajemonline');
        if(isset($_SESSION['costsResult'])) {
            $data = $_SESSION['costsResult'];
            unset($_SESSION['costsResult']);
        } else {
            $data = null;
        }
        $this->set(compact('data'));
    }




    public function depositformeditAction() {
        $this->setMeta('Vyúčtování služeb', 'Description', 'Key, Words, pronajemonline');
        if(isset($_SESSION['depositResult'])) {
            $data = $_SESSION['depositResult'];
            unset($_SESSION['depositResult']);
        } else {
            $data = null;
        }
        $this->set(compact('data'));
    }




    public function servicescalcAction() {
        $this->setMeta('Vyúčtování služeb', 'Description', 'Key, Words, pronajemonline');
        $this->layout = 'pronajemcalc';
        if(!empty($_POST)) {
            $data = $_POST;
            $calculate = new Applications($data);
            $calculate->load($data);
            $result = $calculate->servicesCalculation();
            $result['calcType'] = 'services';
            $_SESSION['costsResult'] = $result;
            $this->set(compact('result'));

        } else {
            throw new \Exception('Stranka není nalezená', 404);
        }
    }

    public function servicescalcpdfAction(){
        $this->pdf = true;
        if(!empty($_SESSION['costsResult'])) {
            $result = $_SESSION['costsResult'];
            $this->set(compact('result'));
        }
        else {
            throw new \Exception('Stranka není nalezená', 404);
        }

    }

    public function electrocalcAction(){
        $this->setMeta('Vyúčtování spotřeby elektřiny', 'Description', 'Key, Words, pronajemonline');
        $this->layout = 'pronajemcalc';
        if(!empty($_POST)) {
            $data = $_POST;
            $calculate = new Applications($data);
            $calculate->load($data);
            $result = $calculate->electroCalculation();
            $result['calcType'] = 'electro';
            $_SESSION['electroResult'] = $result;
            $this->set(compact('result'));
        } else {
            throw new \Exception('Stranka není nalezená', 404);
        }
    }

    public function electrocalcpdfAction(){
        $this->pdf = true;
        if (!empty($_SESSION['electroResult'])) {
            $result = $_SESSION['electroResult'];
            $this->set(compact('result'));
        } else {
            throw new \Exception('Stranka není nalezená', 404);
        }
    }

    public function depositcalcAction(){
        $this->setMeta('Vyúčtování spotřeby elektřiny', 'Description', 'Key, Words, pronajemonline');
        $this->layout = 'pronajemcalc';
        if(!empty($_POST)) {
            $data = $_POST;
            $calculate = new Applications();
            $calculate->load($data);
            $result = $calculate->depositCalculation();
            $result['calcType'] = 'deposit';
            $_SESSION['depositResult'] = $result;
            $this->set(compact('result'));
        } else {
            throw new \Exception('Stranka není nalezená', 404);
        }
    }

    public function depositcalcpdfAction(){
        $this->pdf = true;
        if (!empty($_SESSION['depositResult'])) {
            $result = $_SESSION['depositResult'];
            $this->set(compact('result'));
        } else {
            throw new \Exception('Stranka není nalezená', 404);
        }
    }


}