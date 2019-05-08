<?php


namespace ishop\base;

/** класс вид
 * Class View
 * @package ishop\base
 */
class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $prefix;
    public $template;
    public $data = [];
    public $meta = [];

    public function __construct($route, $template = '', $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;

        if ($template === false) {
            $this->template = false;
        } else {
            $this->template = $template ? : TEMPLATE;
        }
    }

    /** генерация самой страницы
     * @param $data
     * @throws \Exception
     */
    public function render($data)
    {
        if (is_array($data)) extract($data);

        $viewFile = APP . "/views/{$this->prefix}{$this->controller}/$this->view.php";
        if (is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        } else {
            throw new \Exception("Не найден вид $viewFile", 500);
        }

        if ($this->template !== false) {
            $templateFile = APP . "/views/templates/$this->template.php";
            if (is_file($templateFile)) {
                require_once $templateFile;
            } else {
                throw new \Exception("Не найден шаблон $this->template", 500);
            }
        }
    }

    /** генерация метаданных
     * @return string
     */
    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>';
        $output .= '<meta name="description" content="'. $this->meta['desc'] . '">';
        $output .= '<meta name="keywords" content="'. $this->meta['keywords'] . '">';

        return $output;
    }
}