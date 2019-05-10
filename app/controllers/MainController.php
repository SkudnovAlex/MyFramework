<?php

namespace app\controllers;

use ishop\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        //получение брендов
        $brands = \R::find('brand', 'LIMIT 3');
        //получение хитов
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");
        //установка метаданных
        $this->setMeta('Главная страница', 'Описание', 'Ключевые слова');
        //передача данных в шаблон(в вид)
        $this->set(compact('brands', 'hits'));
    }
}