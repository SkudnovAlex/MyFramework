<?php


namespace app\widgets\menu;


use ishop\App;
use ishop\Cache;

class Menu
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $table = 'category';
    protected $cache = 3600;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = [])
    {
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    //получение переданных параметров
    protected function getOptions($options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    //получение данных(категорий)
    protected function run()
    {
        $cache = Cache::instance();
        $this->menuHtml = $cache->getCache($this->cacheKey);
        if (!$this->menuHtml) {
            $this->data = App::$app->getProperty('cats');
            if (!$this->data) {
                $this->data = $cats = \R::getAssoc("SELECT * FROM $this->table");
            }
        }
        $this->output();
    }

    //вывод меню
    protected function output()
    {
        echo $this->menuHtml;
    }

    //создание дерева
    protected function tree()
    {
    }

    //получение HTML меню
    protected function getMenuHtml($tree, $tab = '')
    {
    }

    //собирает категории и возвращает в общее меню
    protected function catToTemplate($category, $tab, $id)
    {
    }
}