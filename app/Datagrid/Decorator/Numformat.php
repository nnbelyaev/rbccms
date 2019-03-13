<?php

namespace App\Datagrid\Decorator;

class Numformat extends Basic
{
    protected $_decimals = 0;

    public function render($colValue, array $options)
    {
        return number_format($colValue, $this->_decimals, ',', ' ');
    }
}
