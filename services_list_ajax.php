<?php

// скрипт кодирует массив наименований расходов для передачи через ajax в main.js для отработки скрипта который отображет  опции select-ов, загрузившихся со страницей (не сбивает значение установленное сессией)

require_once "includes/services.php";
echo json_encode($services);