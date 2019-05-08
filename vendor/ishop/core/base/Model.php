<?php


namespace ishop\base;

/** класс модели. отвечает за работу с данными
 * Class Model
 * @package ishop\base
 */
abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {

    }
}