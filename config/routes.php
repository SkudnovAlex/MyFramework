<?php
use ishop\Router;



//router для админки
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

//router по умолчанию
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
//для остальных страниц
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
