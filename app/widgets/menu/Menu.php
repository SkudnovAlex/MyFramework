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
    protected $class = 'menu';
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
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if($this->cache){
                $cache->setCache($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->output();
    }

    /**
     * вывод меню
     */
    protected function output()
    {
        $attrs = '';
        if (!empty($this->attrs)) {
            foreach ($this->attrs as $k => $v) {
                $attrs .= " $k='$v' ";
            }
        }
        echo "<$this->container class='$this->class' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</$this->container>";
    }

    /** создание дерева
     * @return array
     */
    protected function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    /** получение HTML меню
     * @param $tree
     * @param string $tab
     * @return string
     */
    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    /** собирает категории и возвращает в общее меню
     * @param $category
     * @param $tab
     * @param $id
     * @return false|string
     */
    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}