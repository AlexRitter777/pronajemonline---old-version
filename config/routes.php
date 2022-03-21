<?php

use pronajem\Router;


//default roots
//для админки
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']); //^ - начало строки, $ - конец строки => пустая строка
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);


//для пользователя
Router::add('^$', ['controller' => 'Main', 'action' => 'index']); //^ - начало строки, $ - конец строки => пустая строка => ishop2.loc/, контроллер Main, action - index => по умолчанию
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'); // указываем строковые ключи в массиве controller и action
