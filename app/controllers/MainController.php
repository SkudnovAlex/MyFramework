<?php


namespace app\controllers;


use ishop\base\Controller;

class MainController extends App
{
    public function indexAction()
    {
        debug($this->route);
        debug($this->controller);
        echo __METHOD__;
    }
}