<?php


namespace app\controllers;

use ishop\App;

class CurrencyController extends AppController
{
    public function changeAction()
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if ($currency) {
            $currencies = App::$app->getProperty('currencies');
            if (!empty($currencies[$currency])) {
                setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
            }
        }
        redirect();
    }
}