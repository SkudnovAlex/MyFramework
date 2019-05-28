<?php


namespace ishop\base;

/** класс контроллер
 * Class Controller
 * @package ishop\base
 */
abstract class Controller
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $template;
    public $data = [];
    public $meta = [
        'title' => '',
        'desc' => '',
        'keywords' => '',
    ];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    /**вызов вида
     * @throws \Exception
     */
    public function getView()
    {
        $viewObject = new View($this->route, $this->template, $this->view, $this->meta);
        $viewObject->render($this->data);
    }

    /** установка данных
     * @param $data
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /** установка метаданных
     * @param string $title
     * @param string $desc
     * @param string $keywords
     */
    public function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
        die();
    }
}