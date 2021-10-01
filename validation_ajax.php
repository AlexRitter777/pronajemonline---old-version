<?php
//данный скрипт работает с клиентом через ajax, чтобы не делать это из скрпта validation, кроторый используется так же для проверки в скрипте calculate.php
require_once "validation.php";
if (!$_POST) {
    header('Location: index.php');
}
else {
    echo json_encode($data);
}
?>