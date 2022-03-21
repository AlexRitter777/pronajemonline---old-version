<?php

namespace app\models;

class Services extends AppModel {

    public $services = array(
    'Garáže',
    'Odměny výboru SVJ',
    'Odpad',
    'Pojištění domu',
    'Společná el. energie',
    'Údržba zeleně',
    'Údržba komunikaci, pozemků, zeleně',
    'Úklid',
    'Výtah',
    'Záloha na PCO HZS Praha',
    'Zimní úklid',
    'Údržba společných prostor a revize',
    'Opray, údržba',
    'Režie SVJ',
    'Režie - správní',
    'Provozní režie',
    'Správa domu',
    'Rozúčtování topných nákladů',
    'Náklady na odečty a rozučtování',
    'Havarijní služba',
    'Recepce',
    'Fond oprav',
    'Odměna správci',

    );

    public $meters = array(
    'TUV (Tepla voda)',
    'SUV (Studena voda)',
    'UT (Ustřední topení)',

    );

    public $origins = array(
    'Vyúčtování správce',
    'Předávací protokol'
    );

    public $originsElectro = array(
    'Vyúčtování dodavatele',
    'Předávací protokol'
    );

    public $rentFinishReasons = array(
    'Výpověď',
    'Ukončení smlouvy na dobu určitou',
    'Jiný'
    );

    public $depositItems = array(
        'Přeplatek z vyúčtování služeb',
        'Nedoplatek z vyúčtování služeb',
        'Přeplatek z vyúčtování spotřeby elektřiny',
        'Nedoplatek z vyúčtování spotřeby elektřiny',
        'Váda/poškození'

    );// при добавлении новых позиций- добавить и в main.js


    public function getJsonList($data){
        echo json_encode($data);
    }

    public function getSimplyList($data){
        $count = count($data);
        $i = 0;
        echo '<option id="empty-option"></option>'; //возможно сделаьт отдельным методом - решу после подгрузки из сессии
        while ($i < $count)
        {
            echo('<option value ="' . $data[$i] . '">'. $data[$i] .'</option>');
            $i++;
        }
    }

}