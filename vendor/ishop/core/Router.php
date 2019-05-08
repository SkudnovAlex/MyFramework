<?php


namespace ishop;


use mysql_xdevapi\Exception;

class Router
{
    /** здесь хранятся муршруты
     * @var array
     */
    protected static $routes = [];

    /** текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**добавление правила в маршруты
     * @param $regExp
     * @param array $route
     */
    public static function add($regExp, $route = [])
    {
        self::$routes[$regExp] = $route;
    }

    /** получение маршрутов
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /** получение текущего маршрута
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param $url
     */
    public static function dispatch ($url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод $controller::$action не найдена", 404);
                }
            } else {
                throw new \Exception("Контролер $controller не найдена", 404);
            }
        } else {
            throw new \Exception('Страница не найдена', 404);
        }
    }

    /** поиск соответствующего маршрута
     * @param $url
     * @return bool
     */
    public static function matchRoute ($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;

                return true;
            }
        }
        return false;
    }

    /** приводит строку к формата CamelCase
     * нужно для имен контролеров
     * @param $name
     * @return mixed
     */
    protected static function upperCamelCase($name)
    {
        $name = ucwords(str_replace('-', ' ', $name));
        return str_replace(' ', '', $name);
    }

    /**приводит строку к формату camelCase
     * нужно для методов класса
     * @param $name
     * @return string
     */
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
}