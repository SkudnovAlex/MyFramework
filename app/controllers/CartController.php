<?php


namespace app\controllers;


use app\models\Cart;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $modId = !empty($_GET['mod']) ? (int)$_GET['mod'] : null;
        $mod = null;

        if ($id) {
            $product = \R::findOne('product', 'id = ?', [$id]);
            if (!$product) {
                return false;
            }

            if ($modId) {
                $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$modId, $id]);
            }
        }
        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }
}