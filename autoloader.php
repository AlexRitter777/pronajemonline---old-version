<?php
  function getClass($class){
  require_once('classes/' . $class . '.php');
 
  }
spl_autoload_register('getClass');

  
?>