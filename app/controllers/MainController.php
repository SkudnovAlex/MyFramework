<?php


namespace app\controllers;

class MainController extends AppController
{
    public function indexAction()
    {
//        debug($this->route);
//        debug($this->controller);
//        echo __METHOD__;
        $this->setMeta('Главная страница', 'Описание', 'Ключевые слова');
        $name = 'Гена';
        $age = 25;
        $names = ['Fedya', 'Kolya', 'Vova'];
        $this->set(compact(['name', 'age', 'names']));
    }
}