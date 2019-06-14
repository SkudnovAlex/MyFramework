<?php


namespace app\controllers;

use app\models\Cart;
use ishop\App;

class CurrencyController extends AppController
{
    /**
     * смена валюты
     */
    public function changeAction()
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if ($currency) {
            $currencies = App::$app->getProperty('currencies');
            $curr = \R::findOne('currency', 'code = ?', [$currency]);
            if (!empty($curr)) {
                setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
                Cart::recalc($curr);
            }
        }
        redirect();
    }
}