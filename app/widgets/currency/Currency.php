<?php


namespace app\widgets\currency;

use ishop\App;

/** класс вылют
 * Class Currency
 * @package app\widgets\currency
 */
class Currency
{
    protected $tpl;
    protected $currency;
    protected $currencies;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';
        $this->run();
    }

    /**
     * запуск виджета
     */
    protected function run()
    {
        $this->currencies = App::$app->getProperty('currencies');
        $this->currency = App::$app->getProperty('currency');
        echo $this->getHtml();
    }

    /**получение всех валют
     * @return array
     */
    public static function getCurrencies()
    {
        return \R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC");
    }

    /**получение текущей валюты
     * @param $currencies
     * @return mixed
     */
    public static function getCurrency($currencies)
    {
        if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)) {
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies);
        }
        $currency = $currencies[$key];
        $currency['code'] = $key;

        return $currency;
    }

    /** получение шаблона виджета
     * @return false|string
     */
    protected function getHtml()
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}