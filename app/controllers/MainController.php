<?php


namespace app\controllers;

use ishop\Cache;

class MainController extends AppController
{
    public function indexAction()
    {
        $posts = \R::findAll('test');

        $this->setMeta('Главная страница', 'Описание', 'Ключевые слова');
        $name = 'Гена';
        $age = 25;
        $names = ['Fedya', 'Kolya', 'Vova', 'Miha'];

        $cach = Cache::instance();
        $data = $cach->getCache('test');
        debug($data);
        if (!$data) {
            $cach->setCache('test', $names);
        }
        $this->set(compact(['name', 'age', 'names', 'posts']));
    }
}