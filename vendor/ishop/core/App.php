<?php


namespace ishop;


class App
{
    public static $app;

    function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        self::$app = Registry::instance();
        $this->getParams();
        new ErrorHandler();
    }

    /**
     * получение параметров
     */
    protected function getParams()
    {
        $params = require_once CONF . '/params.php';
        if (!empty($params)) {
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }
}