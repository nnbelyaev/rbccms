<?php

namespace App\Datagrid\Decorator;

abstract class Basic
{
    protected $_params = array();

    public function __construct(array $params = array())
    {
        if ($params) {
            $this->_params = $params;
        }
    }

    abstract public function render($colValue, array $options);
}
