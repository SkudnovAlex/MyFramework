<?php


namespace ishop;


class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG){
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение ', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    /** логирование ошибок
     * @param string $message
     * @param string $file
     * @param string $line
     */
    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[". date('d-m-Y H:i:s') . "] Ошибка: " . $message .
            "| Файл: " . $file . " | Строка: " . $line . "\n====================\n", 3,
            ROOT . '/tmp/errors.log');
    }

    /** показ ошибок
     * @param $erNo
     * @param $errStr
     * @param $errFile
     * @param int $responce
     */
    protected function displayError ($errNo, $errStr, $errFile, $errLine, $responce = 404)
    {
        http_response_code($responce);
        if ($responce == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die();
        }
        if(DEBUG){
            require WWW. '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die();
    }
}