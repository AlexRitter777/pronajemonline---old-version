<?php

// список счетчиков из массива в services.php
// файл загружается ajax в majin.js при добавлении новывых рядов

require_once "autoloader.php";
require_once "includes/services.php";
echo '<option id="empty-option"></option>';
ShowOptionsAbc::showOptions($meters);
